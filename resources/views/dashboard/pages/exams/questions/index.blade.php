@extends('dashboard.layouts.master')

@section('title', __('trans.school_mangement_system') . ' | ' . __('trans.questions_list'))

@section('css')
    @toastr_css
@endsection

@section('content')
     <!-- row -->
     <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="col-xl-12 mb-30">
                        <div class="card card-statistics h-100">
                            <div class="card-body">
                                <a href="{{route('questions.create')}}" class="btn btn-success btn-sm" role="button"
                                   aria-pressed="true">{{ trans('trans.add_question') }}</a><br><br>
                                <div class="table-responsive">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                           data-page-length="50"
                                           style="text-align: center">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">{{ trans('trans.question') }}</th>
                                            <th scope="col">{{ trans('trans.answers') }}</th>
                                            <th scope="col">{{ trans('trans.right_answer') }}</th>
                                            <th scope="col">{{ trans('trans.question_degree') }}</th>
                                            <th scope="col">{{ trans('trans.quizze_name') }}</th>
                                            <th scope="col">{{ trans('trans.processes') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($questions as $index => $question)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{$question->title}}</td>
                                                <td>{{$question->answers}}</td>
                                                <td>{{$question->right_answer}}</td>
                                                <td>{{$question->score}}</td>
                                                <td>{{$question->quizze->name}}</td>
                                                <td>
                                                    <a href="{{route('questions.edit',$question->id)}}"
                                                       class="btn btn-info btn-sm" role="button" aria-pressed="true"><i
                                                            class="fa fa-edit"></i></a>
                                                    <button type="button" class="btn btn-danger btn-sm"
                                                            data-toggle="modal"
                                                            data-target="#delete_exam{{ $question->id }}" title="{{ trans('trans.delete') }}"><i
                                                            class="fa fa-trash"></i></button>
                                                </td>
                                            </tr>

                                        @include('dashboard.pages.exams.questions.delete')
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
