@extends('dashboard.layouts.master')

@section('title', __('trans.school_mangement_system') . ' | ' . __('trans.add_question'))

@section('css')
    @toastr_css
@endsection

@section('content')
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

                    <form class=" row mb-30" action="{{ route('questions.store') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="repeater">
                                <div data-repeater-list="List_Questions">
                                    <div data-repeater-item>
                                        <div class="row">

                                            <div class="col">
                                                <label class="mr-sm-2">{{ trans('trans.question_name') }}</label>
                                                <input type="text" name="title" id="input-name"
                                                    class="form-control form-control-alternative" autofocus>
                                            </div>

                                            <div class="col">
                                                <label for="" class="mr-sm-2">{{ trans('trans.answers') }}</label>
                                                <div class="box">
                                                    <textarea name="answers" class="form-control" id="exampleFormControlTextarea1" rows="1"></textarea>
                                                </div>

                                            </div>

                                            <div class="col">
                                                <label for="" class="mr-sm-2">
                                                    {{ trans('trans.right_answer') }}</label>
                                                <div class="box">
                                                    <input type="text" name="right_answer" id="input-name"
                                                        class="form-control form-control-alternative" autofocus>
                                                </div>
                                            </div>

                                            <div class="col">
                                                <label for="grade_id">{{ trans('trans.quizze_name') }} : <span
                                                        class="text-danger">*</span></label>
                                                <select class="custom-select mr-sm-2" name="quizze_id">
                                                    <option selected disabled>{{ trans('trans.Choose') }}</option>
                                                    @foreach ($quizzes as $quizze)
                                                        <option value="{{ $quizze->id }}">{{ $quizze->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col">
                                                <label >{{ trans('trans.question_degree') }} : <span class="text-danger">*</span></label>
                                                <select class="custom-select mr-sm-2" name="score">
                                                    <option selected disabled> {{ trans('trans.Choose') }}</option>
                                                    <option value="5">5</option>
                                                    <option value="10">10</option>
                                                    <option value="15">15</option>
                                                    <option value="20">20</option>
                                                </select>
                                            </div>

                                            <div class="col">
                                                <label
                                                    class="mr-sm-2">{{ trans('trans.processes') }}:</label>
                                                <input class="btn btn-danger btn-block" data-repeater-delete type="button"
                                                    value="{{ trans('trans.delete_row') }}" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-20">
                                    <div class="col-12">
                                        <input class="button" data-repeater-create type="button"
                                            value="{{ trans('trans.add_row') }}" />
                                    </div>
                                </div><br>
                                <button type="submit" class="btn btn-primary">{{ trans('trans.sure_data') }}</button>
                            </div>
                        </div>
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
