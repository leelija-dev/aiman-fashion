<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (! Schema::hasTable('size_charts')) {
            Schema::create('size_charts', function (Blueprint $table) {
                $table->id();
                $table->string('template_name');
                $table->string('template_code')->unique();
                $table->string('template_type');
                $table->string('config_attribute')->nullable();
                $table->json('size_chart');
                $table->string('image_path')->nullable();
                $table->timestamps();
                $table->softDeletes();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('size_charts');
    }
};
