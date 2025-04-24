@extends('dashboard.layouts.master')
@section('title', __('trans.school_mangement_system') . ' | ' . __('trans.list_processing_fees'))

@section('css')
    @toaster_css
@endsection

@section('content')

    <div class="d-flex align-items-center" style="gap: 5px;">
        <h4 style="font-family: 'Cairo', sans-serif; padding-bottom: 10px;">{{ trans('trans.list_processing_fees') }}</h4>
        <i style="color: green; margin-bottom: 10px;" class="fas fa-money-bill-alt"></i>
    </div>

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
                                                <th>{{ trans('trans.processes') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($processingFees as $index => $processingFee)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $processingFee->students->name }}</td>
                                                    <td>{{ number_format($processingFee->amount, 2) }}</td>
                                                    <td>{{ $processingFee->description }}</td>
                                                    <td>
                                                        <a href="{{ route('processing-fees.edit', $processingFee->id) }}"
                                                            class="btn btn-info btn-sm" role="button"
                                                            aria-pressed="true"><i class="fa fa-edit"></i></a>
                                                        <button type="button" class="btn btn-danger btn-sm"
                                                            data-toggle="modal"
                                                            data-target="#Delete_receipt{{ $processingFee->id }}"><i
                                                                class="fa fa-trash"></i></button>
                                                    </td>
                                                </tr>
                                                @include('dashboard.pages.fees.processingFees.delete')
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
