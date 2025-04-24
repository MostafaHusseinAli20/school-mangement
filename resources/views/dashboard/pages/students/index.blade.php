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
                                                        <div class="dropdown show">
                                                            <a class="btn btn-success btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                {{ trans('trans.processes') }}
                                                            </a>
                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                                <a class="dropdown-item" href="{{route('students.show',$student->id)}}"><i style="color: #ffc107" class="far fa-eye "></i>&nbsp;  {{ trans('trans.show_data_student') }}</a>
                                                                <a class="dropdown-item" href="{{route('students.edit',$student->id)}}"><i style="color:green" class="fa fa-edit"></i>&nbsp;  {{ trans('trans.edit_data_student') }}</a>
                                                                <a class="dropdown-item" href="{{route('fee-invoices.show',$student->id)}}"><i style="color: #0000cc" class="fa fa-edit"></i>&nbsp;{{ trans('trans.add_fee_invoice') }}&nbsp;</a>
                                                                <a class="dropdown-item" href="{{route('student-receipt.show',$student->id)}}"><i style="color: #9dc8e2" class="fas fa-money-bill-alt"></i>&nbsp; &nbsp;{{ trans('trans.receipt') }}</a>
                                                                <a class="dropdown-item" href="{{route('processing-fees.show',$student->id)}}"><i style="color: #9dc8e2" class="fas fa-ticket-alt"></i>&nbsp; &nbsp;{{ trans('trans.exclude_fees') }}</a>
                                                                <a class="dropdown-item" data-target="#Delete_Student{{ $student->id }}" data-toggle="modal" href="##Delete_Student{{ $student->id }}"><i style="color: red" class="fa fa-trash"></i>&nbsp; {{ trans('trans.delete_data_student') }}</a>
                                                            </div>
                                                        </div>
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
