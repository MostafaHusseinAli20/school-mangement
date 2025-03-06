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
        Schema::create('my_parents', function (Blueprint $table) {
            $table->id();

            $table->string('email')->unique();
            $table->string('password');

            // Father Information
            $table->string('name_father');
            $table->string('national_ID_father');
            $table->string('passport_ID_father');
            $table->string('phone_father');
            $table->string('job_father');
            $table->string('address_father');

            //Mother information
            $table->string('name_mother');
            $table->string('national_ID_mother');
            $table->string('passport_ID_mother');
            $table->string('phone_mother');
            $table->string('job_mother');
            $table->string('address_mother');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('my_parents');
    }
};
