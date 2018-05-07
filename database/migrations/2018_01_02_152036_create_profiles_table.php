<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('academic_title_id')->unsigned();
            $table->integer('province_id')->unsigned();
            $table->string('url', 500)->nullable();
            $table->string('path');
            $table->string('name');
            $table->integer('studies_or_papers')->nullable();
            $table->foreign('academic_title_id')
                ->references('id')
                ->on('academic_titles')
                ->onDelete('cascade')->nullable();
            $table->foreign('province_id')
                ->references('id')
                ->on('provinces')
                ->onDelete('cascade')->nullable();
            $table->string('birthday')->nullable();
            $table->text('specialization');
            $table->text('agency')->nullable();
            $table->text('agency_address')->nullable();
            $table->text('research_for')->nullable();
            $table->text('research_joined')->nullable();
            $table->text('research_results')->nullable();
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
        Schema::dropIfExists('profiles');
    }
}
