@extends('dashboard.layouts.master')
@section('css')
    @toastr_css
@endsection
@section('title', __('trans.school_mangement_system') . ' | ' . __('trans.count_student_exam'))

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

                                    <div class="col-md-2">
                                        <label for="statusFilter" class="form-label">{{ trans('trans.status') }}</label>
                                        <select id="statusFilter" name="status" class="form-control p-0 mb-3">
                                            <option value="" disabled selected>{{ trans('trans.Choose') }}</option>
                                            <option value="0">{{ trans('trans.all') }}</option>
                                            <option value="passed">{{ trans('trans-student.passed') }}</option>
                                            <option value="failed">{{ trans('trans-student.failed') }}</option>
                                        </select>
                                    </div>

                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                        data-page-length="50" style="text-align: center">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>{{ trans('trans.student_name') }}</th>
                                                <th>{{ trans('trans-teacher.score') }}</th>
                                                <th>{{ trans('trans-teacher.cancelled_exam') }}</th>
                                                <th>{{ trans('trans.status') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody id="resultsTableBody">
                                            @foreach ($results as $index => $result)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $result->student->name ?? '' }}</td>
                                                    <td>{{ round( $result->student_score, 0 ) }}</td>
                                                    <td>
                                                        <button type="button" class="btn btn-warning btn-sm"
                                                            data-toggle="modal"
                                                            data-target="#cancel_exam{{ $result->id }}"
                                                            title="{{ trans('trans.delete') }}"><i
                                                                class="fa fa-calendar"></i></button>
                                                    </td>
                                                    <td>
                                                        @if ($result->status == 'passed')
                                                            <span
                                                                class="badge badge-success">{{ trans('trans-student.passed') }}</span>
                                                        @else
                                                            <span
                                                                class="badge badge-danger">{{ trans('trans-student.failed') }}</span>
                                                        @endif
                                                    </td>
                                                </tr>

                                                @include('dashboard.pages.teachers.dashboard.quizzes.model-cancelled-exam')
                                            @endforeach
                                            <input type="hidden" name="quiz_id" value="{{ $quiz->id }}">
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
    <script>
        let currentLang = "{{ app()->getLocale() }}";

        $('#statusFilter').on('change', function() {
            let status = $(this).val();
            let quizze_id = "{{ $quiz->id }}"; // هات ID الامتحان من السيرفر

            $.ajax({
                url: "{{ route('teacher.quizzes.status.results') }}", // حط هنا الروت بتاع API
                type: "GET",
                data: {
                    status: status,
                    quiz_id: quizze_id
                },
                success: function(response) {
                    let tbody = $('#resultsTableBody');
                    tbody.empty(); // امسح القديم

                    response.forEach((res, index) => {
                        tbody.append(`
                    <tr>
                        <td>${index + 1}</td>
                        <td>${res.student.name[currentLang] ?? ''}</td>
                        <td>${res.student_score}</td>
                        <td>
                            <button type="button" class="btn btn-warning btn-sm"
                                                            data-toggle="modal"
                                                            data-target="#cancel_exam${ res.id }"
                                                            title="{{ trans('trans.delete') }}"><i
                                                                class="fa fa-calendar"></i></button>
                        </td>
                        <td>
                            ${res.status == 'passed' ? '<span class="badge badge-success">{{ trans('trans-student.passed') }}</span>' : 
                                '<span class="badge badge-danger">{{ trans('trans-student.failed') }}</span>'}
                        </td>
                    </tr>
                `);
                    });
                }
            });
        });
    </script>
@endsection
