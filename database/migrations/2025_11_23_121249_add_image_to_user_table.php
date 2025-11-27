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
        Schema::table('users', function (Blueprint $table) {
            $table->string('image')->nullable();
        });

        Schema::table('my_parents', function (Blueprint $table) {
            $table->string('image')->nullable();
        });

        Schema::table('teachers', function (Blueprint $table) {
            $table->string('image')->nullable();
        });

        Schema::table('students', function (Blueprint $table) {
            $table->string('image')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('image');
        });

        Schema::table('my_parents', function (Blueprint $table) {
            $table->dropColumn('image');
        });

        Schema::table('teachers', function (Blueprint $table) {
            $table->dropColumn('image');
        });

        Schema::table('students', function (Blueprint $table) {
            $table->dropColumn('image');
        });
    }
};
