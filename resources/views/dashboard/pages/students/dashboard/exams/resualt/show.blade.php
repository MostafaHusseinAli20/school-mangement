@extends('dashboard.layouts.master')

@section('title', __('trans.school_mangement_system') . ' | ' . __('trans.students') . ' | ' 
    . __('trans-student.exam_result'))

@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="card-body">
                        <div class="tab nav-border">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active show" id="home-02-tab" data-toggle="tab" href="#home-02"
                                        role="tab" aria-controls="home-02"
                                        aria-selected="true">{{ trans('trans-student.Result_information') }}</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade active show" id="home-02" role="tabpanel"
                                    aria-labelledby="home-02-tab">
                                    <table class="table table-striped table-hover" style="text-align:center">
                                        <tbody>
                                            <tr>
                                                <th scope="row">{{ trans('trans.name') }}</th>
                                                <td>{{ $result->student->name }}</td>
                                                <th scope="row">{{ trans('trans.Email') }}</th>
                                                <td>{{ $result->student->email }}</td>
                                                <th scope="row">{{ trans(key: 'trans-student.exam_name') }}</th>
                                                <td>{{ $quizze->name ?? ''}}</td>
                                                <th scope="row">{{ trans('trans-student.total_questions') }}</th>
                                                <td>{{ $result->total_questions }}</td>
                                            </tr>

                                            <tr>
                                                <th scope="row">{{ trans('trans-student.total_score') }}</th>
                                                <td>{{ round($result->total_score, 0) }}</td>
                                                <th scope="row">{{ trans('trans-student.student_score') }}</th>
                                                <td>{{ round($result->student_score, 0) }}</td>
                                                <th scope="row">{{ trans('trans-student.correct_answers') }}</th>
                                                <td>{{ $result->correct_answers }}</td>
                                                <th scope="row">{{ trans('trans-student.wrong_answers') }}</th>
                                                <td>{{ $result->wrong_answers }}</td>
                                            </tr>

                                            <tr>
                                                <th scope="row">{{ trans('trans-student.percentage') }}</th>
                                                <td>{{ round($result->percentage, 0) }}%</td>
                                                <th scope="row">{{ trans('trans.status') }}</th>
                                                <td>
                                                    @if ($result->status == 'passed')
                                                        <span class="badge badge-success">{{ trans('trans-student.passed') }}</span>
                                                    @else
                                                        <span class="badge badge-danger">{{ trans('trans-student.failed') }}</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        </tbody>
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
