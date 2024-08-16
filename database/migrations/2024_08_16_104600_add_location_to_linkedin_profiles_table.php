<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

 class AddLocationToLinkedinProfilesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('linkedin_profiles', function (Blueprint $table) {
            $table->string('location')->nullable(); // or use `text` if you need more space
        });
    }
    
    public function down()
    {
        Schema::table('linkedin_profiles', function (Blueprint $table) {
            $table->dropColumn('location');
        });
    }
    
};