@extends('dashboard.layouts.master')

@section('title', __('trans.school_mangement_system') . ' | ' . __('trans.parent') . ' | ' .
    __('trans-parent.fees_students'))

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
                                                <th>{{ trans('trans.fee_type') }}</th>
                                                <th>{{ trans('trans.amount') }}</th>
                                                <th>{{ trans('trans-parent.paid') }}</th>
                                                <th>{{ trans('trans-parent.still_amount') }}</th>
                                                <th>{{ trans('trans.grade') }}</th>
                                                <th>{{ trans('trans.acadmy_classe') }}</th>
                                                <th>{{ trans('trans.statement') }}</th>
                                                <th>{{ trans('trans.processes') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($fee_invoices as $index => $fee_invoice)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $fee_invoice->students->name }}</td>
                                                    <td>{{ $fee_invoice->fees->title }}</td>
                                                    <td>{{ number_format($fee_invoice->amount) }}</td>

                                                    <td>{{ number_format(\App\Models\ReceiptStudent::where('student_id', 
                                                    $fee_invoice->students->id)->sum('debit')) }}</td>

                                                    <td>
                                                        {{ $fee_invoice->amount - \App\Models\ReceiptStudent::where('student_id', 
                                                        $fee_invoice->students->id)->sum('debit') }}                               
                                                    </td>

                                                    <td>{{ $fee_invoice->grades->name }}</td>
                                                    <td>{{ $fee_invoice->classes->classe_name }}</td>
                                                    <td>{{ $fee_invoice->description }}</td>
                                                    <td>
                                                        <a href="{{ route('parent.fees.recipt', $fee_invoice->students->id) }}"
                                                            title="{{ trans('trans-parent.fees') }}" class="btn btn-info btn-sm" role="button"
                                                            aria-pressed="true"><i class="fa fa-edit"></i></a>
                                                    </td>
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
