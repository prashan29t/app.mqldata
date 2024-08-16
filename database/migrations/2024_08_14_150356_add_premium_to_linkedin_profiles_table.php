<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPremiumToLinkedinProfilesTable extends Migration
{
    public function up()
    {
        Schema::table('linkedin_profiles', function (Blueprint $table) {
            $table->boolean('premium')->default(false)->after('website');
        });
    }

    public function down()
    {
        Schema::table('linkedin_profiles', function (Blueprint $table) {
            $table->dropColumn('premium');
        });
    }
}