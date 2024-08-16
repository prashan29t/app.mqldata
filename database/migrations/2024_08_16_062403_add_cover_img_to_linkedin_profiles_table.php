<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCoverImgToLinkedinProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('linkedin_profiles', function (Blueprint $table) {
            $table->mediumtext('cover_img')->nullable()->after('profile_photo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('linkedin_profiles', function (Blueprint $table) {
            $table->dropColumn('cover_img');
        });
    }
}