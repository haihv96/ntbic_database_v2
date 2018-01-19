<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('specialization_id')->unsigned();
            $table->foreign('specialization_id')
                ->references('id')
                ->on('specializations')
                ->onDelete('cascade');
            $table->string('url', 500)->unique();
            $table->text('name');
            $table->string('path');
            $table->string('project_code')->nullable();
            $table->string('start_date_invest')->nullable();
            $table->string('close_date')->nullable();
            $table->text('operator')->nullable();
            $table->text('author')->nullable();
            $table->text('highlights')->nullable();
            $table->text('description')->nullable();
            $table->text('transfer_description')->nullable();
            $table->text('results')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
}
