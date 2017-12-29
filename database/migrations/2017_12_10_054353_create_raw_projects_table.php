<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRawProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('raw_projects', function (Blueprint $table) {
            $table->increments('id');
            $table->string('url', 500)->unique();
            $table->text('name');
            $table->string('project_code');
            $table->text('technology_category');
            $table->string('start_date_invest')->nullable();
            $table->string('close_date')->nullable();
            $table->text('operator')->nullable();
            $table->text('author');
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
        Schema::dropIfExists('raw_projects');
    }
}
