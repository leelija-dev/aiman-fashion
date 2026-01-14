<!-- < ?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\Support\Facades\DB; // Add at the top
use App\Models\Backup;
use App\Models\Admin;

class BackupController extends Controller
{
    public function index()
    {
        $backups = Backup::orderByDesc('created_at')->get();
        return view('admin.backup.index', compact('backups'));
    }

    public function createBackup(Request $request)
    {
        $backupDir = storage_path('app/db-backups');
        File::ensureDirectoryExists($backupDir);

        $fileName = 'backup_' . date('Ymd_His') . '.sql';
        $filePath = $backupDir . '/' . $fileName;

        $file = fopen($filePath, 'w');
        $dbName = DB::getDatabaseName();

        $tables = DB::select("SHOW TABLES");
        $key = 'Tables_in_' . $dbName;

        foreach ($tables as $table) {
            $tableName = $table->$key;

            $create = DB::select("SHOW CREATE TABLE `$tableName`")[0]->{'Create Table'};
            fwrite($file, "DROP TABLE IF EXISTS `$tableName`;\n$create;\n\n");

            $rows = DB::table($tableName)->get();

            foreach ($rows as $row) {
                $columns = array_map(fn($col) => "`$col`", array_keys((array)$row));
                $values = array_map(fn($val) => is_null($val) ? 'NULL' : "'" . addslashes($val) . "'", array_values((array)$row));
                $insert = "INSERT INTO `$tableName` (" . implode(', ', $columns) . ") VALUES (" . implode(', ', $values) . ");\n";
                fwrite($file, $insert);
            }

            fwrite($file, "\n\n");
        }

        fclose($file);

        // Store in DB
        Backup::create([
            'file_name' => $fileName,
        ]);

        return redirect()->back()->with('success', 'Backup created: ' . $fileName);
    }

    // public function createBackup(Request $request)
    // {
    //     $backupDir = storage_path('app/db-backups');
    //     File::ensureDirectoryExists($backupDir);

    //     $fileName = 'backup_' . date('Ymd_His') . '.sql';
    //     $filePath = $backupDir . '/' . $fileName;

    //     $file = fopen($filePath, 'w');
    //     $dbName = DB::getDatabaseName();

    //     $excludeTables = [
    //         'migrations',
    //         'password_resets',
    //         'personal_access_tokens',
    //         'failed_jobs',
    //         'sessions',
    //         'model_has_roles',
    //         'model_has_permissions',
    //         'role_has_permissions',
    //         'jobs',
    //         'cache',
    //     ];

    //     $tables = DB::select("SHOW TABLES");
    //     $key = 'Tables_in_' . $dbName;

    //     foreach ($tables as $table) {
    //         $tableName = $table->$key;

    //         if (in_array($tableName, $excludeTables)) {
    //             continue; // skip Laravel system tables
    //         }

    //         // Export CREATE TABLE
    //         $create = DB::select("SHOW CREATE TABLE `$tableName`")[0]->{'Create Table'};
    //         fwrite($file, "DROP TABLE IF EXISTS `$tableName`;\n$create;\n\n");

    //         // Export data
    //         $rows = DB::table($tableName)->get();

    //         foreach ($rows as $row) {
    //             $columns = array_map(fn($col) => "`$col`", array_keys((array)$row));
    //             $values = array_map(fn($val) => is_null($val) ? 'NULL' : "'" . addslashes($val) . "'", array_values((array)$row));
    //             $insert = "INSERT INTO `$tableName` (" . implode(', ', $columns) . ") VALUES (" . implode(', ', $values) . ");\n";
    //             fwrite($file, $insert);
    //         }

    //         fwrite($file, "\n\n");
    //     }

    //     fclose($file);

    //     // Store in database
    //     Backup::create([
    //         'file_name' => $fileName,
    //     ]);

    //     return redirect()->back()->with('success', 'Backup created: ' . $fileName);
    // }


    public function download($fileName)
    {
        $path = storage_path('app/db-backups/' . $fileName);
        if (!file_exists($path)) {
            return back()->with('error', 'File not found.');
        }
        return response()->download($path);
    }

    public function restore($fileName)
    {
        ini_set('memory_limit', '1024M');
        $path = storage_path('app/db-backups/' . $fileName);

        if (!file_exists($path)) {
            return back()->with('error', 'Backup file not found.');
        }

        try {
            // Read the .sql file
            $sql = File::get($path);

            // Disable foreign key checks to avoid issues while truncating tables
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');

            // Drop all tables (clean slate)
            $database = DB::getDatabaseName();
            $tables = DB::select("SHOW TABLES");
            $key = "Tables_in_$database";
            foreach ($tables as $table) {
                DB::statement('DROP TABLE IF EXISTS `' . $table->$key . '`');
            }

            // Re-enable foreign key checks
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');

            // Run the SQL
            DB::unprepared($sql);
            // Admin::logout();
            Auth::logout();


            return back()->with('success', 'Database has been restored successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Restore failed: ' . $e->getMessage());
        }
    }

    // public function restore($fileName)
    // {
    //     $path = storage_path('app/db-backups/' . $fileName);

    //     if (!file_exists($path)) {
    //         return back()->with('error', 'Backup file not found.');
    //     }

    //     try {
    //         $db = config('database.connections.mysql');

    //         $user = escapeshellarg($db['username']);
    //         $pass = escapeshellarg($db['password']);
    //         $dbName = escapeshellarg($db['database']);
    //         $path = escapeshellarg($path); // add quotes and escape spaces

    //         $cmd = "mysql -u $user -p$pass $dbName < $path";

    //         // dd($cmd);

    //         exec($cmd, $output, $status);
    //         // dd($cmd, $output, $status);

    //         if ($status !== 0) {
    //             return back()->with('error', 'Restore failed. Check SQL syntax or permissions.');
    //         }

    //         Admin::logout();
    //         session()->invalidate();
    //         session()->regenerateToken();

    //         return redirect()->route('login')->with('success', 'Database restored. Please log in again.');
    //     } catch (\Exception $e) {
    //         return back()->with('error', 'Exception: ' . $e->getMessage());
    //     }
    // }

    // public function restore($fileName)
    // {
    //     $path = storage_path('app/db-backups/' . $fileName);

    //     if (!file_exists($path)) {
    //         return back()->with('error', 'Backup file not found.');
    //     }

    //     try {
    //         $db = config('database.connections.mysql');

    //         $user = $db['username'];
    //         $pass = $db['password'];
    //         $dbName = $db['database'];

    //         // Wrap in cmd /c for Windows redirection support
    //         $cmd = 'cmd /c "mysql -u ' . $user . ' -p' . $pass . ' ' . $dbName . ' < ' . $path . '"';

    //         exec($cmd, $output, $status);

    //         // if ($status !== 0) {
    //         //     return back()->with('error', 'Restore failed. Check SQL syntax or permissions.');
    //         // }


    //         session()->invalidate();
    //         session()->regenerateToken();

    //         return redirect()->route('login')->with('success', 'Database restored successfully. Please log in again.');
    //     } catch (\Exception $e) {
    //         return back()->with('error', 'Restore exception: ' . $e->getMessage());
    //     }
    // }
} -->
