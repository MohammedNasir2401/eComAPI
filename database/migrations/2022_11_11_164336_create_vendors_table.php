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
        Schema::create('vendors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
                $table->string('logo')->nullable();
                $table->boolean('is_active')->default(0);
                $table->boolean('is_verified')->default(0);
                $table->string('trade_license')->nullable();
                $table->date('license_expiry_date')->nullable();
                $table->longText('address')->nullable();
                $table->string('phone')->nullable();
                $table->string('website')->nullable();
                $table->string('city')->nullable();
                $table->string('country')->nullable();

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
        Schema::dropIfExists('vendors');
    }
};
