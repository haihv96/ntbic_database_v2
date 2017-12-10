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
            $table->string('image')->nullable();
            $table->text('name');
            $table->string('last_update');
            $table->text('technology_category');
            $table->string('province');
            $table->text('headquarters');
            $table->string('email');
            $table->string('phone');
            $table->string('fax');
            $table->string('website');
            $table->text('company_code');
            $table->text('tax_code');
            $table->string('type');
            $table->string('founded');
            $table->string('founder');
            $table->string('founder_phone');
            $table->string('founder_email');
            $table->text('founder_address');
            $table->text('industry');
            $table->text('tax_information');
            $table->text('company_branch');
            $table->text('representative_office');
            $table->string('TRC_number');
            $table->string('TRC_date');
            $table->text('TRC_place');
            $table->string('technology_rank');
            $table->text('research_for');
            $table->string('number_of_employees_research');
            $table->text('technology_highlight');
            $table->text('technology_using');
            $table->text('technology_transfer');
            $table->text('results');
            $table->text('products');
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
