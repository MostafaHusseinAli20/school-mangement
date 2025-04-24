@extends('dashboard.layouts.master')

@section('title', __('trans.school_mangement_system') . ' | ' . __('trans.edit_exam'))

@section('css')
    @toastr_css
@endsection

@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">

                    @if (session()->has('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>{{ session()->get('error') }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <div class="col-xs-12">
                        <div class="col-md-12">
                            <br>
                            <form action="{{ route('exams.update', $exam->id) }}" method="post">
                                @csrf
                                @method('patch')
                                <div class="form-row">

                                    <div class="col">
                                        <label for="title">{{ trans('trans.exam_name_ar') }}</label>
                                        <input type="text" name="name_ar"
                                            value="{{ $exam->getTranslation('name', 'ar') }}" class="form-control">
                                        <input type="hidden" name="id" value="{{ $exam->id }}">
                                    </div>

                                    <div class="col">
                                        <label for="title">{{ trans(key: 'trans.exam_name_en') }}</label>
                                        <input type="text" name="name_en"
                                            value="{{ $exam->getTranslation('name', 'en') }}" class="form-control">
                                    </div>

                                    <div class="col">
                                        <label for="title">{{ trans('trans.term') }}</label>
                                        <input type="number" name="term" value="{{ $exam->term }}"
                                            class="form-control">
                                    </div>

                                </div>
                                <br>

                                <div class="form-row">
                                    <div class="form-group col">
                                        <label for="academic_year">{{trans('trans.study_year')}} : <span
                                                class="text-danger">*</span></label>
                                        <select class="custom-select mr-sm-2" name="academic_year">
                                            <option selected disabled>{{ trans('trans.Choose') }}...</option>
                                            @php
                                                $current_year = date('Y');
                                            @endphp
                                            @for ($year = $current_year; $year <= $current_year + 1; $year++)
                                                <option value="{{ $year }}"
                                                    {{ $year == $exam->academic_year ? 'selected' : '' }}>{{ $year }}
                                                </option>
                                            @endfor
                                        </select>
                                    </div>

                                </div>
                                <button class="btn btn-success btn-sm nextBtn btn-lg pull-right"
                                    type="submit">{{ trans('trans.sure_data') }}</button>
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
