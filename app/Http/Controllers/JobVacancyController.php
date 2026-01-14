<!-- < ?php

namespace App\Http\Controllers;
use App\models\JobVacancy;
use App\models\Departments;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
class JobVacancyController extends Controller implements HasMiddleware
{
    //
     public static function middleware()
    {
        return [

            new Middleware('permission:view job', only: ['JobVacancyFun']),
            new Middleware('permission:edit job', only: ['editVacancy']),
            new Middleware('permission:create job', only: ['JobVacancyFun']),
            new Middleware('permission:delete job', only: ['deleteVacancy']),
        ];
    }
    public function showInsertForm()
            {
                $departments = Departments::where('status', 1)->get();
                return view('admin.jobvacancy', compact('departments'));
            }
    public function JobVacancyFun(Request $request)
        {
           
            $data=$request->validate([
                
                'job_role'  => 'required|string|max:255',
                'exprience' => 'required|string',
                'location'  => 'required|string|max:255',
                'skills'    => 'required|array',
                'skills.*'  => 'string',
                'description'=>'required|string',
                'department'=>'required|string',
                'status'=>'required|string'
                
            ]);
            
            $data['skills'] = implode(',', $data['skills']); // convert to string
            $data['created_at'] = now();
            $data['updated_at'] = now();
            $plainText = strip_tags($data['description']);
            $data['description'] = $plainText;

            JobVacancy::create($data);
            return redirect(route('showjobvacancy'))->with('success','job inserted sucessfull');
            }
    public function ShowJobVacancy(){
        $user=JobVacancy::all();
        
        if($user){
        return view('admin.alljobvacancy',['data'=>$user]);
        }
        else{
            return "<h1> not found</h1>";
        }
        }
    
    public function deleteVacancy($id)
        {
            //$user=JobVacancy::where('id',$id)->delete();
            $vacancy = JobVacancy::findOrFail($id); // Get the record or fail

            $vacancy->delete();
           
           
            return redirect()->route('showjobvacancy')->with('success','Job vacancy Deleted sucessfull');
            
        }
    public function editVacancy($id){
        $user=JobVacancy::where('id',$id)->first();
       
            if($user){
        return view('admin.updatevacancy',['user' => $user]);
        }
    }
    public function updateVacancy(Request $request, $id)
        {
            $data=$request->validate([
                'job_role'  => 'required|string|max:255',
                'exprience' => 'required|string',
                'location'  => 'required|string|max:255',
                'skills'      => 'required|array',
                'skills.*'    => 'string',
                'description'=>'nullable|string',
                'department'=>'required|string',
                'status'=>'required|string'
                
            ]);
            $data['skills'] = implode(',', $data['skills']); // convert to string
            $data['updated_at'] = now();
            $user=JobVacancy::where('id',$id)->update($data);
            if($user){
            return redirect()->route('showjobvacancy')->with('success','Job Vacancy updated sucessfull');
            }
        }
     

public function ShowVacancy($id)
{
    $user = JobVacancy::findOrFail($id); 
    return view('admin.showjob', compact('user'));
}

//    public function ShowVacancy($id){
//     $user = JobVacancy::find($id); // Fetch user by ID or return 404
//     return (route('show',compact('user')));
// }
//  public function ShowJob(){
//     return view('admin.showjob');
// }
   }
 -->
