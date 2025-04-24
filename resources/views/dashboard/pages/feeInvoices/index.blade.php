@extends('dashboard.layouts.master')
@section('title', __('trans.school_mangement_system') . ' | ' . __('trans.list_fees_invoices'))
    
@section('css')
    @toaster_css
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
                                           data-page-length="50"
                                           style="text-align: center">
                                        <thead>
                                        <tr class="alert-success">
                                            <th>#</th>
                                            <th>{{ trans('trans.name') }}</th>
                                            <th>{{ trans('trans.fee_type') }}</th>
                                            <th>{{ trans('trans.amount') }}</th>
                                            <th>{{ trans('trans.grade') }}</th>
                                            <th>{{ trans('trans.acadmy_classe') }}</th>
                                            <th>{{ trans('trans.statement') }}</th>
                                            <th>{{ trans('trans.processes') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($feeInvoices as $index => $feeInvoice)
                                            <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{$feeInvoice->students->name}}</td>
                                            <td>{{$feeInvoice->fees->title}}</td>
                                            <td>{{ number_format($feeInvoice->amount, 2) }}</td>
                                            <td>{{$feeInvoice->grades->name}}</td>
                                            <td>{{$feeInvoice->classes->classe_name}}</td>
                                            <td>{{$feeInvoice->description}}</td>
                                                <td>
                                                    <a href="{{ route('fee-invoices.edit', $feeInvoice->id) }}" class="btn btn-info btn-sm" role="button" aria-pressed="true"><i class="fa fa-edit"></i></a>
                                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#Delete_Fee_invoice{{$feeInvoice->id}}" ><i class="fa fa-trash"></i></button>
                                                </td>
                                            </tr>
                                            @include('dashboard.pages.feeInvoices.delete')
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