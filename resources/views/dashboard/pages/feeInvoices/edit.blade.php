@extends('dashboard.layouts.master')
@section('title', __('trans.school_mangement_system') . ' | ' . __('trans.fee_invoice_edit'))
    
@section('css')
    @toaster_css
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

                    <form action="{{route('fee-invoices.update',$fee_invoice->id)}}" method="post" autocomplete="off">
                        @csrf
                        @method('PUT')
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="inputEmail4">{{ trans('trans.student_name') }}</label>
                                <input type="text" value="{{$fee_invoice->students->name}}" readonly name="title_ar" class="form-control">
                                <input type="hidden" value="{{$fee_invoice->id}}" name="id" class="form-control">
                            </div>


                            <div class="form-group col">
                                <label for="inputEmail4">{{ trans('trans.amount') }}</label>
                                <input type="number" value="{{$fee_invoice->amount}}" name="amount" class="form-control">
                            </div>

                        </div>


                        <div class="form-row">

                            <div class="form-group col">
                                <label for="inputZip">{{ trans('trans.fee_type') }}</label>
                                <select class="custom-select mr-sm-2" name="fee_id">
                                    @foreach($fees as $fee)
                                        <option value="{{$fee->id}}" {{$fee->id == $fee_invoice->fee_id ? 'selected':"" }}>{{$fee->title}}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>

                        <div class="form-group">
                            <label for="inputAddress">{{ trans('trans.notes') }}</label>
                            <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="4">{{$fee_invoice->description}}</textarea>
                        </div>
                        <br>

                        <button type="submit" class="btn btn-primary">{{ trans('trans.sure') }}</button>

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