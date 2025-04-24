@extends('dashboard.layouts.master')
@section('title', __('trans.school_mangement_system') . ' | ' . __('trans.student-graduate'))
    
@section('css')
    @toastr_css
@endsection

@section('content')
    <h4 style="font-family: 'Cairo', sans-serif; margin-bottom: 5px;">{{ trans('trans.list_graduates') }} <i class="fas fa-user-graduate"></i></h4>
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
                                           data-page-length="50"
                                           style="text-align: center">
                                        <thead>
                                        <tr class="alert-success">
                                            <th>#</th>
                                            <th>{{trans('trans.name')}}</th>
                                            <th>{{trans('trans.Email')}}</th>
                                            <th>{{trans('trans.gender')}}</th>
                                            <th>{{trans('trans.grade')}}</th>
                                            <th>{{trans('trans.classes')}}</th>
                                            <th>{{trans('trans.section')}}</th>
                                            <th>{{trans('trans.processes')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($students as $index => $student)
                                            <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{$student->name}}</td>
                                            <td>{{$student->email}}</td>
                                            <td>{{$student->genders->name}}</td>
                                            <td>{{$student->grades->name}}</td>
                                            <td>{{$student->classes->classe_name}}</td>
                                            <td>{{$student->sections->name_section}}</td>
                                                <td>
                                                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#Return_Student{{ $student->id }}" title="{{ trans('trans.delete') }}">{{ trans('trans.rollback_student') }}</button>
                                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#Delete_Student{{ $student->id }}" title="{{ trans('trans.delete') }}">{{ trans('trans.deleted_student') }}</button>

                                                </td>
                                            </tr>
                                        @include('dashboard.pages.students.graduated.return')
                                        @include('dashboard.pages.students.graduated.delete')
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