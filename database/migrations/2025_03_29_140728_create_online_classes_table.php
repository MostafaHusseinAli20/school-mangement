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
        Schema::create('online_classes', function (Blueprint $table) {
            $table->id();
            $table->string('meeting_id')->unique();
            $table->string('meeting_topic');
            $table->dateTime('meeting_start_at');
            $table->integer('meeting_duration')->comment('minutes');
            $table->string('meeting_password');
            $table->string('start_url',600);
            $table->string('join_url');
            $table->string('type')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('online_classes');
    }
};
