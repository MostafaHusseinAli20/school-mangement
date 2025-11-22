@extends('dashboard.layouts.master')

@section('title', __('trans.school_mangement_system') . ' | ' . __('trans.students') . ' | ' . __('trans.exams'))

@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="col-xl-12 mb-30">
                        <div class="card card-statistics h-100">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                        data-page-length="50" style="text-align: center">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>{{ trans('trans-student.subject') }}</th>
                                                <th>{{ trans('trans-student.name_exam') }}</th>
                                                <th>{{ trans('trans-student.show_degree') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($quizzes as $quizze)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $quizze->subject->name }}</td>
                                                    <td>{{ $quizze->name }}</td>
                                                    <td>
                                                        @if ($answer && $result)
                                                            <a href="{{ route('students.exams.result', $quizze->id) }}"
                                                                class="btn btn-outline-warning btn-sm" role="button"
                                                                aria-pressed="true">{{ trans('trans-student.show_degree') }}
                                                                <i class="fas fa-person-booth"></i></a>
                                                        @else
                                                            <a href="{{ route('students.exams.show', $quizze->id) }}"
                                                                class="btn btn-outline-success btn-sm" role="button"
                                                                aria-pressed="true" onclick="alertAbuse()">
                                                                <i class="fas fa-person-booth"></i></a>
                                                        @endif
                                                    </td>
                                                </tr>
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

    <script>
        alertAbuse = () => {
            alert('{{ trans('trans-student.alertAbuse') }}');
        }
    </script>
@endsection
