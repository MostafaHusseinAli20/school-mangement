@extends('dashboard.layouts.master')
@section('title', __('trans.school_mangement_system') . ' | ' . __('trans.edit_processing_fee'))

@section('css')
    @toaster_css
@endsection

@section('content')
{{ trans('trans.edit_exclude_fees') }}  : <label style="color: red;font-family: 'Cairo', sans-serif;">
    {{$processingFee->students->name}}</label>
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

                    <form action="{{ route('processing-fees.update', $processingFee->id) }}" method="post" autocomplete="off">
                        @csrf
                        @method('PUT')
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>{{ trans('trans.amount') }} : <span class="text-danger">*</span></label>
                                    <input class="form-control" name="debit" value="{{ $processingFee->amount }}"
                                        type="number">
                                    <input type="hidden" name="student_id" value="{{ $processingFee->students->id }}"
                                        class="form-control">
                                    <input type="hidden" name="id" value="{{ $processingFee->id }}"
                                        class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>{{ trans('trans.statement') }} : <span class="text-danger">*</span></label>
                                    <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3">{{ $processingFee->description }}</textarea>
                                </div>
                            </div>

                        </div>

                        <button class="btn btn-success btn-sm nextBtn btn-lg pull-right"
                            type="submit">{{ trans('trans.submit') }}</button>
                    </form>

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
