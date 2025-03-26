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
            $table->foreignId('gender_id')->constrained('genders')->cascadeOnDelete()->cascadeOnUpdate();
        });
        
        Schema::table('students', function(Blueprint $table){
            $table->foreignId('gender_id')->constrained('genders')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('nationality_id')->constrained('nationalities')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('type_blood_id')->constrained('type_bloods')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('grade_id')->constrained('grades')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('classe_id')->constrained('classes')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('section_id')->constrained('sections')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('parent_id')->constrained('my_parents')->cascadeOnDelete()->cascadeOnUpdate();
        });

        Schema::table('fees', function(Blueprint $table){
            $table->foreignId('grade_id')->constrained('grades')->cascadeOnDelete();
            $table->foreignId('classe_id')->constrained('classes')->cascadeOnDelete();
        });
        
        Schema::table('fee_invocies', function(Blueprint $table){
            $table->foreignId('student_id')->constrained('students')->cascadeOnDelete();
            $table->foreignId('grade_id')->constrained('grades')->cascadeOnDelete();
            $table->foreignId('classe_id')->constrained('classes')->cascadeOnDelete();
            $table->foreignId('fee_id')->constrained('fees')->cascadeOnDelete();
            $table->timestamps();
        });

        Schema::table('student_accounts', function(Blueprint $table){
            $table->foreignId('student_id')->constrained('students')->cascadeOnDelete();
            $table->foreignId('receipt_id')->nullable()->constrained('receipt_students')->cascadeOnDelete();
            $table->foreignId('processing_id')->nullable()->constrained('processing_fees')->cascadeOnDelete();
            $table->foreignId('grade_id')->constrained('grades')->cascadeOnDelete();
            $table->foreignId('classe_id')->constrained('classes')->cascadeOnDelete();
            $table->timestamps();
        });

        Schema::table('attendances', function(Blueprint $table){
            $table->foreignId('student_id')->constrained('students')->cascadeOnDelete();
            $table->foreignId('grade_id')->constrained('grades')->cascadeOnDelete();
            $table->foreignId('classe_id')->constrained('classes')->cascadeOnDelete();
            $table->foreignId('section_id')->constrained('sections')->cascadeOnDelete();
            $table->foreignId('teacher_id')->constrained('teachers')->cascadeOnDelete();
            $table->timestamps();
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

        Schema::table('students', function(Blueprint $table){
            $table->dropForeign('students_gender_id_foreign');
            $table->dropForeign('students_nationality_id_foreign');
            $table->dropForeign('students_type_blood_id_foreign');
            $table->dropForeign('students_type_grade_id_foreign');
            $table->dropForeign('students_type_classe_id_foreign');
            $table->dropForeign('students_type_section_id_foreign');
            $table->dropForeign('students_type_parent_id_foreign');
        });

        Schema::table('fees', function(Blueprint $table){
            $table->dropForeign('fees_grade_id_foreign');
            $table->dropForeign('fees_classe_id_foreign');
        });

        Schema::table('fee_invocies', function(Blueprint $table){
            $table->dropForeign('fee_invocies_student_id_foreign');
            $table->dropForeign('fee_invocies_grade_id_foreign');
            $table->dropForeign('fee_invocies_classe_id_foreign');
            $table->dropForeign('fee_invocies_fee_id_foreign');
        });

        Schema::table('student_accounts', function(Blueprint $table){
            $table->dropForeign('student_accounts_student_id_foreign');
            $table->dropForeign('student_accounts_receipt_id_foreign');
            $table->dropForeign('student_accounts_processing_id_foreign');
            $table->dropForeign('student_accounts_grade_id_foreign');
            $table->dropForeign('student_accounts_classe_id_foreign');
        });

        Schema::table('attendances', function(Blueprint $table){
            $table->dropForeign('attendances_student_id_foreign');
            $table->dropForeign('attendances_grade_id_foreign');
            $table->dropForeign('attendances_classe_id_foreign');
            $table->dropForeign('attendances_section_id_foreign');
            $table->dropForeign('attendances_teacher_id_foreign');
        });
    }
};
