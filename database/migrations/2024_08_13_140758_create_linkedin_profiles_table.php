<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLinkedinProfilesTable extends Migration
{
    public function up()
    {
        Schema::create('linkedin_profiles', function (Blueprint $table) {
            $table->id();
            $table->integer('batch_job')->nullable()->default(0);
            $table->string('full_name', 200)->nullable();
            $table->string('first_name', 50)->nullable();
            $table->string('last_name', 50)->nullable();
            $table->string('public_identifier', 50)->nullable();
            $table->string('username', 50)->nullable();
            $table->string('linkedin_url', 255)->nullable();
            $table->mediumtext('profile_photo')->nullable();
            $table->text('headline')->nullable();
            $table->text('job_title')->nullable();
            $table->text('snippet')->nullable();
            $table->string('address')->nullable();
            $table->string('city', 50)->nullable();
            $table->string('state', 50)->nullable();
            $table->string('zipcode', 15)->nullable();
            $table->string('country', 50)->nullable();
            $table->string('country_code', 12)->nullable();
            $table->string('followers', 150)->nullable();
            $table->string('connections', 150)->nullable();
            $table->text('about')->nullable();
            $table->text('experience')->nullable();
            $table->text('education')->nullable();
            $table->string('email')->nullable();
            $table->string('phone', 15)->nullable();
            $table->string('website', 50)->nullable();
            $table->unsignedBigInteger('company_id')->nullable();
            $table->timestamps();

            $table->foreign('company_id')->references('id')->on('linkedin_companies')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('linkedin_profiles');
    }
}