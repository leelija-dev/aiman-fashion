<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTemplateAssignTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::create('template_assign', function (Blueprint $table) {
        $table->id();
        $table->unsignedInteger('product_id');
        $table->unsignedBigInteger('template_id');
        $table->timestamps();

        $table->foreign('product_id')
              ->references('id')
              ->on('product_flat')
              ->onDelete('cascade');

        $table->foreign('template_id')
              ->references('id')
              ->on('size_charts')
              ->onDelete('cascade');
    });
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('template_assign');
    }
}
