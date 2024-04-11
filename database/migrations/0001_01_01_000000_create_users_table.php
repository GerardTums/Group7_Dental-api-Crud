<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id('user_id')->primary();
            $table->string('name')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->timestamps();
        });

        Schema::create('profiles', function (Blueprint $table) {
            $table->unsignedBigInteger('profile_id')->primary();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
            $table->string('first_name');
            $table->string('last_name');
            $table->integer('age');
            $table->string('address');
            $table->integer('contact');
            $table->string('email')->unique();
            $table->timestamps(); 
        });

        Schema::create('dentists', function (Blueprint $table) {
            $table->id('dentist_id')->primary();
            $table->string('name')->unique();
            $table->string('email')->unique();
            $table->integer('years_of_service');
        });

        Schema::create('promos', function (Blueprint $table) {
            $table->id('promo_id')->primary();
            $table->decimal('discount', 5, 2);
            $table->string('description');
            $table->integer('price');
            $table->string('promo_name');
            $table->date('promo_end');
            $table->timestamps();
        });

        Schema::create('membership', function (Blueprint $table) {
            $table->id('membership_id')->primary();
            #$table->unsignedBigInteger('promo_id');
            $table->foreignId('promo_id')->references('promo_id')->on('promos');
            #$table->unsignedBigInteger('profile_id');
            $table->foreignId('profile_id')->references('profile_id')->on('profiles');
            $table->timestamps();
        });

        Schema::create('nurses', function (Blueprint $table) {
            $table->id('nurse_id')->primary();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('user_id')->on('users');
            $table->string('name')->unique();
            $table->string('email')->unique();
            $table->integer('years_of_service');
        });

       
        Schema::create('procedures', function (Blueprint $table) {
            $table->id('procedure_id')->primary();
            $table->unsignedBigInteger('promo_id');
            $table->foreign('promo_id')->references('promo_id')->on('promos');
            $table->string('description');
            $table->integer('cost');
        });
        

        Schema::create('appointments', function (Blueprint $table) {
            $table->id('appointment_id')->primary();
            $table->timestamps();
            $table->date('treatment_date');
            $table->time('treatment_time');
            $table->unsignedBigInteger('dentist_id');
            $table->foreign('dentist_id')->references('dentist_id')->on('dentists');
            $table->unsignedBigInteger('nurse_id');
            $table->foreign('nurse_id')->references('nurse_id')->on('nurses');
            $table->unsignedBigInteger('profile_id');
            $table->foreign('profile_id')->references('profile_id')->on('profiles');
            $table->unsignedBigInteger('procedure_id');
            $table->foreign('procedure_id')->references('procedure_id')->on('procedures');
        });

        
        Schema::create('reschedules', function (Blueprint $table) {
            $table->id('schedule_id')->primary();
            $table->unsignedBigInteger('appointment_id');
            $table->foreign('appointment_id')->references('appointment_id')->on('appointments');
            $table->date('new_schedule');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('membership');
        Schema::dropIfExists('procedures');
        Schema::dropIfExists('rescedules');
        Schema::dropIfExists('apointments');
        Schema::dropIfExists('promos');
        Schema::dropIfExists('nurses');
        Schema::dropIfExists('dentists');
        Schema::dropIfExists('profiles');
        Schema::dropIfExists('users');
    }
};
