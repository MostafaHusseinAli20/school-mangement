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
        Schema::table('classes', function (Blueprint $table) {
            $table->foreignId('grade_id')->constrained('grades')->cascadeOnDelete()->cascadeOnUpdate();
        });

        Schema::table('sections', function (Blueprint $table) {
            $table->foreignId('grade_id')->constrained('grades')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('classe_id')->constrained('classes')->cascadeOnDelete()->cascadeOnUpdate();
        });

        Schema::table('my_parents', function(Blueprint $table) {
            $table->foreignId('nationality_father_id')->constrained('nationalities')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('blood_type_father_id')->constrained('type_bloods')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('religion_father_id')->constrained('religions')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('nationality_mother_id')->constrained('nationalities')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('blood_type_mother_id')->constrained('type_bloods')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('religion_mother_id')->constrained('religions')->cascadeOnDelete()->cascadeOnUpdate();
        });

        Schema::table('parent_attachments', function(Blueprint $table) {
            $table->foreignId('parent_id')->constrained('my_parents')->cascadeOnDelete()->cascadeOnUpdate();
        });

        Schema::table('teachers', function(Blueprint $table){
            $table->foreignId('specialist_id')->constrained('specialisations')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('grade_id')->constrained('grades')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('gender_id')->constrained('genders')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('classes', function (Blueprint $table) {
            $table->dropForeign('classes_grade_id_foreign');
        });
        Schema::table('sections', function (Blueprint $table) {
            $table->dropForeign('sections_grade_id_foreign');
            $table->dropForeign('sections_classe_id_foreign');
        });
        Schema::table('my_parents', function(Blueprint $table) {
            $table->dropForeign('my_parents_nationality_father_id_foreign');
            $table->dropForeign('my_parents_blood_type_father_id_foreign');
            $table->dropForeign('my_parents_religion_father_id_foreign');
            $table->dropForeign('my_parents_nationality_mother_id_foreign');
            $table->dropForeign('my_parents_blood_type_mother_id_foreign');
            $table->dropForeign('my_parents_religion_mother_id_foreign');
        });
        Schema::table('parent_attachments', function(Blueprint $table){
            $table->dropForeign('parent_attachments_parent_id_foreign');
        });
        Schema::table('teachers', function(Blueprint $table){
            $table->dropForeign('teachers_specialist_id_foreign');
            $table->dropForeign('teachers_gender_id_foreign');
            $table->dropForeign('teachers_grade_id_foreign');
        });
    }
};
