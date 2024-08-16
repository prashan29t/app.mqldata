<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesSkillsTable extends Migration
{
    public function up()
    {
        Schema::create('profiles_skills', function (Blueprint $table) {
            $table->id();
            $table->foreignId('linkedin_profile_id')->constrained('linkedin_profiles')->onDelete('cascade');
            $table->string('skill')->nullable();
            $table->timestamps(); // No need to call `nullable()`
        });
    }

    public function down()
    {
        Schema::dropIfExists('profiles_skills');
    }
}