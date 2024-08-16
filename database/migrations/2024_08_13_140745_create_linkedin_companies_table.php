<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLinkedinCompaniesTable extends Migration
{
    public function up()
    {
        Schema::create('linkedin_companies', function (Blueprint $table) {
            $table->id();
            $table->integer('batch_job')->nullable()->default(0);
            $table->string('linkedin_url')->nullable();
            $table->string('username')->nullable();
            $table->string('name')->nullable();
            $table->string('website', 50)->nullable();
            $table->string('address')->nullable();
            $table->string('city', 50)->nullable();
            $table->string('state', 50)->nullable();
            $table->string('zipcode', 15)->nullable();
            $table->string('country', 50)->nullable();
            $table->string('country_code', 12)->nullable();
            $table->string('phone', 15)->nullable();
            $table->string('industry', 100)->nullable();
            $table->string('employees', 10)->nullable();
            $table->string('revenue', 100)->nullable();
            $table->text('about')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('linkedin_companies');
    }
}