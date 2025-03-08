@extends('dashboard.layouts.master')

@section('title', __('trans.school_mangement_system') . " | " . __('trans.add_teacher'))


@section('css')
    @toastr_css
@endsection

@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">

                    

                    <div class="col-xs-12">
                        <div class="col-md-12">
                            <br>
                            <form action="{{ route('teachers.store') }}" method="POST">
                                @if (session()->has('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>{{ session()->get('error') }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">

                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                                @csrf
                                <div class="form-row">
                                    <div class="col">
                                        <label for="title">{{ trans('trans.Email') }}</label>
                                        <input type="email" name="email" class="form-control">
                                        @error('email')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <label for="title">{{ trans('trans.Password') }}</label>
                                        <input type="password" name="password" class="form-control">
                                        @error('password')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <br>


                                <div class="form-row">
                                    <div class="col">
                                        <label for="title">{{ trans('trans.name_teacher_ar') }}</label>
                                        <input type="text" name="name_teacher_ar" class="form-control">
                                        @error('name_teacher_ar')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <label for="title">{{ trans('trans.name_teacher_en') }}</label>
                                        <input type="text" name="name_teacher_en" class="form-control">
                                        @error('name_teacher_en')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <br>
                                <div class="form-row">
                                    <div class="form-group col">
                                        <label for="inputCity">{{ trans('trans.specialization') }}</label>
                                        <select class="custom-select my-1 mr-sm-2" name="specialist_id">
                                            <option selected disabled>{{ trans('trans.Choose') }}...</option>
                                            @foreach ($specializations as $specialization)
                                                <option value="{{ $specialization->id }}">{{ $specialization->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('specialist_id')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col">
                                        <label for="inputState">{{ trans('trans.gender') }}</label>
                                        <select class="custom-select my-1 mr-sm-2" name="gender_id">
                                            <option selected disabled>{{ trans('trans.Choose') }}...</option>
                                            @foreach ($genders as $gender)
                                                <option value="{{ $gender->id }}">{{ $gender->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('gender_id')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <br>

                                <div class="form-row">
                                    <div class="col">
                                        <label for="title">{{ trans('trans.joining_date') }}</label>
                                        <div class='input-group date'>
                                            <input class="form-control" type="text" id="datepicker-action"
                                                name="joining_data" data-date-format="yyyy-mm-dd" required>
                                        </div>
                                        @error('joining_data')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <br>

                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">{{ trans('trans.address') }}</label>
                                    <textarea class="form-control" name="address" id="exampleFormControlTextarea1" rows="4"></textarea>
                                    @error('address')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <button class="btn btn-success btn-sm nextBtn btn-lg pull-right"
                                    type="submit">{{ trans('trans.Next') }}
                                </button>
                                
                            </form>
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
