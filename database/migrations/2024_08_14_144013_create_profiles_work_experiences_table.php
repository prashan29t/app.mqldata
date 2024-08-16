<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesWorkExperiencesTable extends Migration
{
    public function up()
    {
        Schema::create('profiles_work_experiences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('linkedin_profile_id')->constrained('linkedin_profiles')->onDelete('cascade');
            $table->string('company_name')->nullable();
            $table->string('company_url')->nullable();
            $table->string('logo_url')->nullable();
            $table->string('job_title')->nullable();
            $table->string('employment_type')->nullable();
            $table->string('duration')->nullable();
            $table->string('location')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('profiles_work_experiences');
    }
}