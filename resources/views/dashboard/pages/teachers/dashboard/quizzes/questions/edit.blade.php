@extends('dashboard.layouts.master')
@section('css')
    @toastr_css
@endsection

@section('content')
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
                            <form action="{{ route('teacher.quizzes.questions.update', $question->id) }}" method="post"
                                autocomplete="off">
                                @csrf
                                @method('PUT')
                                <div class="form-row">
                                    <div class="col">
                                        <label for="title">{{ trans('trans.question') }}</label>
                                        <input type="text" name="title" class="form-control"
                                            value="{{ $question->title }}">
                                    </div>
                                </div>
                                <br>

                                <div class="form-row">

                                    <div class="col">
                                        <div class="form-group">
                                            <label for="answers">{{ trans('trans.answers') }} : <span
                                                    class="text-danger">*</span></label>
                                            <textarea type="text" name="answers" class="form-control">{{ $question->answers }}</textarea>
                                        </div>
                                    </div>

                                </div>

                                <div class="form-row">

                                    <div class="col">
                                        <div class="form-group">
                                            <label for="right_answer">{{ trans('trans.right_answer') }} : <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="right_answer" value="{{ $question->right_answer }}"
                                                class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col mt-3">
                                        <label class="mr-sm-2">{{ trans('trans.question_degree') }} : <span
                                                class="text-danger">*</span></label>
                                        <select class="form-control p-0 mb-4" name="score">
                                            <option selected disabled>{{ trans('trans.Choose') }}</option>
                                            <option {{ $question->score == 5 ? 'selected' : '' }} value="5">5
                                            </option>
                                            <option {{ $question->score == 10 ? 'selected' : '' }} value="10">10
                                            </option>
                                            <option {{ $question->score == 15 ? 'selected' : '' }} value="15">15
                                            </option>
                                            <option {{ $question->score == 20 ? 'selected' : '' }} value="20">20
                                            </option>
                                        </select>
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
    </div>
    </div>
@endsection

@section('js')
    @toastr_js
    @toastr_render
@endsection
