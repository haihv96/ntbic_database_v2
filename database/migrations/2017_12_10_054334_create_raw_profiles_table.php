<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRawProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('raw_profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('url', 500)->unique();
            $table->string('name');
            $table->integer('studies_or_papers')->nullable();
            $table->string('acadamic_title')->nullable();
            $table->string('birthday')->nullable();
            $table->text('specialization');
            $table->text('agency')->nullable();
            $table->text('agency_address')->nullable();
            $table->text('research_for')->nullable();
            $table->text('research_joined');
            $table->text('research_results');
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
        Schema::dropIfExists('raw_profiles');
    }
}
