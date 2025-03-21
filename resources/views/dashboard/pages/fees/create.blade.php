@extends('dashboard.layouts.master')
@section('title', __('trans.school_mangement_system') . ' | ' . __('trans.add_fee'))
    
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

                    <form method="post" action="{{ route('fees.store') }}" autocomplete="off">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="inputEmail4">{{ trans('trans.title_ar') }}</label>
                                <input type="text" value="{{ old('title_ar') }}" name="title_ar" class="form-control">
                            </div>

                            <div class="form-group col">
                                <label for="inputEmail4">{{ trans('trans.title_en') }}</label>
                                <input type="text" value="{{ old('title_en') }}" name="title_en" class="form-control">
                            </div>


                            <div class="form-group col">
                                <label for="inputEmail4">{{ trans('trans.amount') }}</label>
                                <input type="number" value="{{ old('amount') }}" name="amount" class="form-control">
                            </div>

                        </div>


                        <div class="form-row">

                            <div class="form-group col">
                                <label for="inputState">{{ trans('trans.grade') }}</label>
                                <select class="custom-select mr-sm-2" name="grade_id">
                                    <option selected disabled>{{trans('trans.Choose')}}...</option>
                                    @foreach($grades as $grade)
                                        <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col">
                                <label for="inputZip">{{ trans('trans.acadmy_classe') }}</label>
                                <select class="custom-select mr-sm-2" name="classe_id">

                                </select>
                            </div>
                            <div class="form-group col">
                                <label for="inputZip">{{ trans('trans.study_year') }}</label>
                                <select class="custom-select mr-sm-2" name="year">
                                    <option selected disabled>{{trans('trans.Choose')}}...</option>
                                    @php
                                        $current_year = date("Y")
                                    @endphp
                                    @for($year=$current_year; $year<=$current_year +1 ;$year++)
                                        <option value="{{ $year}}">{{ $year }}</option>
                                    @endfor
                                </select>
                            </div>

                            <div class="form-group col">
                                <label for="inputState">{{ trans('trans.Fee_Type') }}</label>
                                <select class="custom-select mr-sm-2" name="fee_type">
                                    <option selected disabled>{{trans('trans.Choose')}}...</option>
                                    
                                    <option value="1">مصاريف دراسية</option>
                                    <option value="2">مصاريف الباص</option>
                                    <option value="3">مصاريف الزي المدرسي</option>

                                </select>
                            </div>

                        </div>

                        <div class="form-group">
                            <label for="inputAddress">{{ trans('trans.notes') }}</label>
                            <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="4"></textarea>
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