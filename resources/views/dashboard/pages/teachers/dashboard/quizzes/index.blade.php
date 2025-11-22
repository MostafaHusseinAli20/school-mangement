@extends('dashboard.layouts.master')
@section('css')
    @toastr_css
@endsection
@section('title', __('trans.school_mangement_system') . ' | ' . __('trans.quizzes_list'))

@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="col-xl-12 mb-30">
                        <div class="card card-statistics h-100">
                            <div class="card-body">
                                <a href="{{route('teacher.quizzes.create')}}" class="btn btn-success btn-sm" role="button"
                                   aria-pressed="true">{{ trans('trans.add_quizze') }}</a><br><br>
                                <div class="table-responsive">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                           data-page-length="50"
                                           style="text-align: center">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{ trans('trans.quizze_name') }}</th>
                                            <th>{{ trans('trans.name_teacher') }}</th>
                                            <th>{{ trans('trans.grade') }}</th>
                                            <th>{{ trans('trans.classes') }}</th>
                                            <th>{{ trans('trans.section') }}</th>
                                            <th>{{ trans('trans.count_questions') }}</th>
                                            <th>{{ trans('trans.questions') }}</th>
                                            <th>{{ trans('trans.show_students_exam') }}</th>
                                            <th>{{ trans('trans.processes') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($quizzes as $index => $quizze)
                                            <tr>
                                                <td>{{ $index + 1}}</td>
                                                <td>{{$quizze->name}}</td>
                                                <td>{{$quizze->teacher->name}}</td>
                                                <td>{{$quizze->grade->name}}</td>
                                                <td>{{$quizze->classe->classe_name}}</td>
                                                <td>{{$quizze->section->name_section}}</td>
                                                <td>
                                                    {{ $quizze->questions->count() }}
                                                </td>
                                                <td>
                                                    <a href="{{ route('teacher.quizzes.questions.create', $quizze->id) }}"
                                                       class="btn btn-warning btn-sm" role="button" aria-pressed="true"><i
                                                            class="fa fa-edit"></i> {{ trans('trans.add') }}</a>
                                                </td>
                                                <td>
                                                    <a href="{{ route('teacher.quizzes.count.exam', $quizze->id) }}"
                                                       class="btn btn-info btn-sm" role="button" aria-pressed="true"><i
                                                            class="fa fa-list"></i> {{ trans('trans.count_student_exam') }}</a>
                                                </td>
                                                <td>
                                                    <a href="{{route('teacher.quizzes.edit',$quizze->id)}}"
                                                       class="btn btn-info btn-sm" role="button" aria-pressed="true"><i
                                                            class="fa fa-edit"></i></a>
                                                    <button type="button" class="btn btn-danger btn-sm"
                                                            data-toggle="modal"
                                                            data-target="#delete_exam{{ $quizze->id }}" title="{{ trans('trans.delete') }}"><i
                                                            class="fa fa-trash"></i></button>
                                                </td>
                                            </tr>

                                            @include('dashboard.pages.teachers.dashboard.quizzes.delete')
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection
@section('js')
    @toastr_js
    @toastr_render
@endsection