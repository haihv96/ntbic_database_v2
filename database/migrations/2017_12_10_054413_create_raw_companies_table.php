<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRawCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('raw_companies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('url', 500)->unique();
            $table->text('name');
            $table->string('last_update')->nullable();
            $table->text('technology_category')->nullable();
            $table->string('province')->nullable();
            $table->text('headquarters')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('fax')->nullable();
            $table->string('website')->nullable();
            $table->text('company_code')->nullable();
            $table->text('tax_code')->nullable();
            $table->string('type')->nullable();
            $table->string('founded')->nullable();
            $table->string('founder')->nullable();
            $table->string('founder_phone')->nullable();
            $table->string('founder_email')->nullable();
            $table->text('founder_address')->nullable();
            $table->text('industry')->nullable();
            $table->text('tax_information')->nullable();
            $table->text('company_branch')->nullable();
            $table->text('representative_office')->nullable();
            $table->string('TRC_number')->nullable();
            $table->string('TRC_date')->nullable();
            $table->text('TRC_place')->nullable();
            $table->string('technology_rank')->nullable();
            $table->text('research_for')->nullable();
            $table->string('number_of_employees_research')->nullable();
            $table->text('technology_highlight')->nullable();
            $table->text('technology_using')->nullable();
            $table->text('technology_transfer')->nullable();
            $table->text('results')->nullable();
            $table->text('products')->nullable();
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
        Schema::dropIfExists('raw_companies');
    }
}
