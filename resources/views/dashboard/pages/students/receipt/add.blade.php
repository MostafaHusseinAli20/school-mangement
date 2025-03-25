@extends('dashboard.layouts.master')

@section('title', __('trans.school_mangement_system') . ' | ' . __('trans.create_receipt'))

@section('css')
    @toastr_css
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

                        <form method="post"  action="{{ route('student-receipt.store') }}" autocomplete="off">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>{{ trans('trans.amount') }} : <span class="text-danger">*</span></label>
                                        <input  class="form-control" name="debit" type="number" >
                                        <input  type="hidden" name="student_id"  value="{{$student->id}}" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>{{ trans('trans.statement') }} : <span class="text-danger">*</span></label>
                                        <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3"></textarea>
                                    </div>
                                </div>
                            </div>
                            
                            <input type="hidden" name="grade_id" value="{{$student->grade_id}}">
                            <input type="hidden" name="classe_id" value="{{$student->classe_id}}">

                            <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit">{{trans('trans.submit')}}</button>
                            
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
