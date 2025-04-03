@extends('dashboard.layouts.master')

@section('title', __('trans.school_mangement_system') . ' | ' . __('trans.onlineclasses_indirect_create'))

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

                    <form method="post" action="{{ route('online.indirect_store') }}" autocomplete="off">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>{{ trans('trans.grade') }} : <span
                                            class="text-danger">*</span></label>
                                    <select class="custom-select mr-sm-2" name="grade_id">
                                        <option selected disabled>{{ trans('trans.Choose') }}...</option>
                                        @foreach ($grades as $grade)
                                            <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="Classroom_id">{{ trans('trans.classes') }} : <span
                                            class="text-danger">*</span></label>
                                    <select class="custom-select mr-sm-2" name="classe_id">

                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="section_id">{{ trans('trans.section') }} : </label>
                                    <select class="custom-select mr-sm-2" name="section_id">

                                    </select>
                                </div>
                            </div>
                        </div><br>

                        <div class="row">

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>{{ trans('trans.onlineclass_meeting_id') }} : <span class="text-danger">*</span></label>
                                    <input class="form-control" name="meeting_id" type="number">
                                </div>
                            </div>


                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>{{ trans('trans.onlineclass_name') }} : <span class="text-danger">*</span></label>
                                    <input class="form-control" name="meeting_topic" type="text">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>{{ trans('trans.onlineclass_date') }} : <span class="text-danger">*</span></label>
                                    <input class="form-control" type="datetime-local" name="meeting_start_at">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>{{ trans('trans.onlineclass_time') }} : <span class="text-danger">*</span></label>
                                    <input class="form-control" name="meeting_duration" type="number">
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>{{ trans('trans.onlineclass_password') }} : <span class="text-danger">*</span></label>
                                    <input class="form-control" name="meeting_password" type="text">
                                </div>
                            </div>


                        </div>

                        <div class="row">

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>{{ trans('trans.start_url') }} : <span class="text-danger">*</span></label>
                                    <input class="form-control" name="start_url" type="text">
                                </div>
                            </div>

                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>{{ trans('trans.join_url') }} : <span class="text-danger">*</span></label>
                                    <input class="form-control" name="join_url" type="text">
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
