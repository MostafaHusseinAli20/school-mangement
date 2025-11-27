@extends('dashboard.layouts.master')

@section('title', __('trans.school_mangement_system') . ' | ' . __('trans-parent.parents') . ' | ' .
    __('trans-parent.recipt_fees'))

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
                                <div class="table-responsive">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                        data-page-length="50" style="text-align: center">
                                        <thead>
                                            <tr class="alert-success">
                                                <th>#</th>
                                                <th>{{ trans('trans.name') }}</th>
                                                <th>{{ trans('trans.amount') }}</th>
                                                <th>{{ trans('trans.statement') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($recipt_students as $index => $recipt_student)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $recipt_student->students->name }}</td>
                                                    <td>{{ number_format($recipt_student->debit, 2) }}</td>
                                                    <td>{{ $recipt_student->description }}</td>
                                                </tr>
                                            @endforeach
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
