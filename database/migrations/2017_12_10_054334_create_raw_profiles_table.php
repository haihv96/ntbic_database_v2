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
            $table->integer('studies_or_papers');
            $table->string('acadamic_title');
            $table->string('birthday');
            $table->text('specialization');
            $table->text('agency');
            $table->text('agency_address');
            $table->text('research_for');
            $table->text('research_joined');
            $table->text('research_results');
            $table->string('image')->nullable();
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
