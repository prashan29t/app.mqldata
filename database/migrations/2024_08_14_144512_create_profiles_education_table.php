<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesEducationTable extends Migration
{
    public function up()
    {
        Schema::create('profiles_education', function (Blueprint $table) {
            $table->id();
            $table->foreignId('linkedin_profile_id')->constrained('linkedin_profiles')->onDelete('cascade');
            $table->string('institution')->nullable();
            $table->string('degree')->nullable();
            $table->text('details')->nullable();
            $table->text('date_range')->nullable(); 
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('profiles_education');
    }
}