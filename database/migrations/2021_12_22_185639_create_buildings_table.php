<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->foreignId('company_id');
            $table->string('internal_code')->unique();
            $table->tinyInteger('status');
            $table->string('pib')->unique();
            $table->string('identification_number')->unique();
            $table->string('account_number')->unique();
            $table->string('balance');
            $table->string('construction_year');
            $table->integer('square');
            $table->tinyInteger('floors');
            $table->boolean('elevator');
            $table->boolean('yard');
            $table->string('address');
            $table->string('city');
            $table->string('county');
            $table->string('postal_code');
            $table->string('balance_begining');
            $table->text('comment')->nullable();
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
};
