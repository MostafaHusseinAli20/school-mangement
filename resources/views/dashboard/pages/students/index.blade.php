@extends('dashboard.layouts.master')

@section('title', __('trans.school_mangement_system') . ' | ' . __('trans.students_list'))

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
                                <a href="{{ route('students.create') }}" class="btn btn-success btn-sm" role="button"
                                    aria-pressed="true">{{ trans('trans.add_student') }}</a><br><br>
                                <div class="table-responsive">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                        data-page-length="50" style="text-align: center">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>{{ trans('trans.name') }}</th>
                                                <th>{{ trans('trans.Email') }}</th>
                                                <th>{{ trans('trans.gender') }}</th>
                                                <th>{{ trans('trans.grade') }}</th>
                                                <th>{{ trans('trans.classes') }}</th>
                                                <th>{{ trans('trans.section') }}</th>
                                                <th>{{ trans('trans.processes') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($students as $index => $student)
                                              <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $student->name }}</td>
                                                    <td>{{ $student->email }}</td>
                                                    <td>{{ $student->genders->name }}</td>
                                                    <td>{{ $student->grades->name }}</td>
                                                    <td>{{ $student->classes->classe_name }}</td>
                                                    <td>{{ $student->sections->name_section }}</td>
                                                    <td>
                                                        <a href="{{ route('students.edit', $student->id) }}"
                                                            class="btn btn-info btn-sm" role="button"
                                                            aria-pressed="true"><i class="fa fa-edit"></i></a>
                                                        <button type="button" class="btn btn-danger btn-sm"
                                                            data-toggle="modal"
                                                            data-target="#Delete_Student{{ $student->id }}"
                                                            title="{{ trans('grade.delete') }}"><i
                                                                class="fa fa-trash"></i></button>
                                                        <a href="{{ route('students.show', $student->id) }}" class="btn btn-warning btn-sm" role="button"
                                                            aria-pressed="true"><i class="far fa-eye"></i></a>
                                                    </td>
                                                </tr>
                                                @include('dashboard.pages.students.delete')
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
