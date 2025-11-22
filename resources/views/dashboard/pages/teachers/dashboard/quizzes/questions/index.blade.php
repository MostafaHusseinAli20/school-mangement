@extends('dashboard.layouts.master')
@section('css')
    @toastr_css
@endsection
@section('title', __('trans.school_mangement_system') . ' | ' . __('trans.questions_list'))

@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="col-xl-12 mb-30">
                        <div class="card card-statistics h-100">
                            <div class="card-body">

                                <div class="col-2 mb-3">
                                    <form id="quizForm">
                                        @csrf
                                        <label for="quizSelect">{{ trans('trans-teacher.choose_quizze') }}</label>
                                        <span class="text-danger">*</span>
                                        <select name="quizze_id" id="quizSelect" class="form-control p-0">
                                            <option value="" disabled selected>{{ trans('trans.Choose') }}</option>
                                            <option value="0">{{ trans('trans.all') }}</option>
                                            @foreach ($quizzes as $quiz)
                                                <option value="{{ $quiz->id }}">{{ $quiz->name }}</option>
                                            @endforeach
                                        </select>
                                    </form>
                                </div>

                                <div class="table-responsive">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                        data-page-length="50" style="text-align: center">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>{{ trans('trans.question') }}</th>
                                                <th>{{ trans('trans.answers') }}</th>
                                                <th>{{ trans('trans.right_answer') }}</th>
                                                <th>{{ trans('trans-teacher.score') }}</th>
                                                <th>{{ trans('trans.processes') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody id="questionsTableBody">
                                            @foreach ($questions as $index => $question)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $question->title }}</td>
                                                    <td>{{ $question->answers }}</td>
                                                    <td>{{ $question->right_answer }}</td>
                                                    <td>{{ $question->score }}</td>
                                                    <td>
                                                        <a href="{{ route('teacher.quizzes.questions.edit', $question->id) }}"
                                                            class="btn btn-info btn-sm" role="button"
                                                            aria-pressed="true"><i class="fa fa-edit"></i></a>
                                                        <button type="button" class="btn btn-danger btn-sm"
                                                            data-toggle="modal"
                                                            data-target="#delete_exam{{ $question->id }}"
                                                            title="{{ trans('trans.delete') }}"><i
                                                                class="fa fa-trash"></i></button>
                                                    </td>
                                                </tr>

                                                @include('dashboard.pages.teachers.dashboard.quizzes.questions.delete')
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
        $(document).ready(function() {
            $('#quizSelect').on('change', function() {
                let quizze_id = $(this).val();

                if (quizze_id !== "") {
                    $.ajax({
                        url: "{{ route('teacher.quizzes.search') }}",
                        type: "GET",
                        data: {
                            quizze_id: quizze_id
                        },
                        success: function(response) {
                            let tableBody = $('#questionsTableBody');
                            tableBody.empty(); // امسح الجدول القديم

                            if (response.length > 0) {
                                $.each(response, function(index, question) {
                                    tableBody.append(`
                                <tr>
                                    <td>${index + 1}</td>
                                    <td>${question.title}</td>
                                    <td>${question.answers}</td>
                                    <td>${question.right_answer}</td>
                                    <td>${question.score}</td>
                                    <td>
                                        <a href="/teachers/questions/edit/${question.id}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a>
                                        <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete_exam${question.id}">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            `);
                                });
                            } else {
                                tableBody.append(
                                    '<tr><td colspan="6">لا توجد أسئلة متاحة</td></tr>');
                            }
                        },
                        error: function() {
                            alert('حدث خطأ أثناء جلب البيانات.');
                        }
                    });
                }
            });
        });
    </script>
@endsection
