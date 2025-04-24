@extends('dashboard.layouts.master')

@section('title', __('trans.school_mangement_system') . ' | ' . __('trans.choose_exam'))

@section('css')
    <style>

    </style>
    @toastr_css
@endsection

@section('content')

    <div class="d-flex justify-content-around align-items-center">
        <a href="{{ route('exams.index') }}" class="card w-25">
            <img src="{{ asset('assets/images/NewFolder/img_avatar.png') }}" alt="Avatar" style="width:100%">
            <div class="container">
                <h4 class="mt-3" style="font-family: 'Cairo', sans-serif;"><b>امتحانات سنوية</b></h4>
                <p class="mb-3" style="font-family: 'Cairo', sans-serif;">ترم اول وثاني من كل سنة دراسية</p>
            </div>
        </a>

        <a href="{{ route('quizzes.index') }}" class="card w-25">
            <img src="{{ asset('assets/images/NewFolder/img_avatar2.png') }}" alt="Avatar" style="width:100%">
            <div class="container">
                <h4 class="mt-3" style="font-family: 'Cairo', sans-serif;"><b>امتحانات اونلاين</b></h4>
                <p class="mb-3" style="font-family: 'Cairo', sans-serif;">امتحانات عبر المنصة في كل مادة</p>
            </div>
        </a>
    </div>

@endsection

@section('js')
    @toastr_js
    @toastr_render
@endsection
