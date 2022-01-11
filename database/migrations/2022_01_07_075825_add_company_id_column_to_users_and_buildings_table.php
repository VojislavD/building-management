<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCompanyIdColumnToUsersAndBuildingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('company_id')->after('id')->references('id')->on('companies')->onDelete('cascade');
        });

        Schema::table('buildings', function (Blueprint $table) {
            $table->foreignId('company_id')->after('id')->references('id')->on('companies')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('company_id');
        });

        Schema::table('buildings', function (Blueprint $table) {
            $table->dropColumn('company_id');
        });
    }
}