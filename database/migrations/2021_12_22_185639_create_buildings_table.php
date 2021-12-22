<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuildingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buildings', function (Blueprint $table) {
            $table->id();
            $table->integer('internal_code')->unique();
            $table->string('pib')->unique();
            $table->string('identification_number')->unique();
            $table->string('account_number')->unique();
            $table->string('balance');
            $table->string('construction_year');
            $table->integer('square');
            $table->tinyInteger('floors');
            $table->integer('apartments');
            $table->integer('tenants');
            $table->boolean('elevator');
            $table->boolean('yard');
            $table->string('address');
            $table->string('city');
            $table->string('municipality');
            $table->string('postal_code');
            $table->string('balance_begining');
            $table->text('comment');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('buildings');
    }
}
