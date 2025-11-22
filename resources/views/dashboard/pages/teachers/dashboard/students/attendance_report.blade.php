@extends('dashboard.layouts.master')
@section('css')
    @toastr_css
@endsection

@section('title')
    {{ trans('trans-teacher.attendacne_report') }}
@endsection

@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="post" action="{{ route('teacher.attendance.report.search') }}" autocomplete="off">
                        @csrf
                        <h6 style="font-family: 'Cairo', sans-serif;color: blue">
                            {{ trans('trans-teacher.search_details') }}
                        </h6><br>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="student">{{ trans('trans-teacher.students') }}</label>
                                    <select class="custom-select mr-sm-2" name="student_id">
                                        <option value="0">
                                            {{ trans('trans-teacher.all') }}
                                        </option>
                                        @foreach ($students as $student)
                                            <option value="{{ $student->id }}">{{ $student->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="card-body datepicker-form">
                                <div class="input-group" data-date-format="yyyy-mm-dd">
                                    <input type="text" class="form-control range-from date-picker-default"
                                        placeholder="{{ trans('trans-teacher.start_date') }}" required name="from">
                                    <span class="input-group-addon">{{ trans('trans-teacher.end_date') }}</span>
                                    <input class="form-control range-to date-picker-default"
                                        placeholder="{{ trans('trans-teacher.end_date') }}" type="text" required
                                        name="to">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="student">{{ trans('trans.attendance') }}</label>
                                    <select class="custom-select mr-sm-2" name="attendance_status">
                                        <option value="0">
                                            {{ trans('trans-teacher.all') }}
                                        </option>
                                        <option value="1">
                                            {{ trans('trans.presence') }}
                                        </option>
                                        <option value="2">
                                            {{ trans('trans.absent') }}
                                        </option>
                                    </select>
                                </div>
                            </div>

                        </div>
                        <button class="btn btn-success btn-sm nextBtn btn-lg pull-right"
                            type="submit">{{ trans('trans.submit') }}</button>
                    </form>
                    @isset($Students)
                        <div class="table-responsive">
                            <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                                style="text-align: center">
                                <thead>
                                    <tr>
                                        <th class="alert-success">#</th>
                                        <th class="alert-success">{{ trans('trans.name') }}</th>
                                        <th class="alert-success">{{ trans('trans.grade') }}</th>
                                        <th class="alert-success">{{ trans('trans.section') }}</th>
                                        <th class="alert-success">{{ trans('trans-teacher.date') }}</th>
                                        <th class="alert-warning">{{ trans('trans.status') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($Students as $student)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $student->students->name }}</td>
                                            <td>{{ $student->grade->name }}</td>
                                            <td>{{ $student->section->name_section }}</td>
                                            <td>{{ $student->attendance_date }}</td>
                                            <td>
                                               @if ($student->attendance_status == 1)
                                                    <span class="badge badge-success">{{ trans('trans.presence') }}</span>
                                               @else
                                                    <span class="badge badge-danger">{{ trans('trans.absent') }}</span>
                                               @endif
                                            </td>
                                        </tr>
                                        {{-- @include('pages.Students.Delete') --}}
                                    @endforeach
                            </table>
                        </div>
                    @endisset

                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection
@section('js')
@endsection
