@extends('dashboard.layouts.master')

@section('title', __('trans.school_mangement_system') . ' | ' 
    . __('trans.students') . ' | ' . __('trans.exams'))
    
@section('content')
    <div id="app">
        <question-component quizze-id="{{ $quizze_id }}" student-id="{{ $student_id }}"></question-component>
    </div>
    @vite('resources/js/app.js')
@endsection

@section('js')
    @toastr_js
    @toastr_render
@endsection
