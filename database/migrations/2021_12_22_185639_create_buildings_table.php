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
            $table->integer('internal_code');
            $table->string('pib');
            $table->string('identification_number');
            $table->string('account_number');
            $table->string('balance');
            $table->string('construction_year');
            $table->boolean('yard');
            $table->boolean('elevator');
            $table->string('address');
            $table->string('city');
            $table->string('municipality');
            $table->string('postal_code');
            $table->tinyInteger('floors');
            $table->tinyInteger('apartments');
            $table->tinyInteger('tenants');
            $table->tinyInteger('square');
            $table->string('balance_begining');
            $table->text('comment');
            $table->timestamps();
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
