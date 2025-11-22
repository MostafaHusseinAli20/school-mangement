@extends('dashboard.layouts.master')

@section('title', __('trans.school_mangement_system') . ' | ' . __('trans.new_question'))

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

                    <form class="row mb-30" action="{{ route('teacher.quizzes.questions.store', $quizze_id) }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="repeater">
                                <div data-repeater-list="List_Questions">
                                    <div data-repeater-item>
                                        <div class="row">

                                            <div class="col mt-3">
                                                <label class="mr-sm-2">{{ trans('trans.title_question') }}</label>
                                                <input type="text" name="title" class="form-control">
                                            </div>

                                            <div class="col mt-3">
                                                <label class="mr-sm-2">{{ trans('trans.question_degree') }} : <span
                                                        class="text-danger">*</span></label>
                                                <select class="fancyselect mr-sm-2" name="score">
                                                    <option selected disabled>{{ trans('trans.Choose') }}</option>
                                                    <option value="5">5</option>
                                                    <option value="10">10</option>
                                                    <option value="15">15</option>
                                                    <option value="20">20</option>
                                                </select>
                                            </div>

                                            <div class="col-12 mt-3">
                                                <label for="title"> {{ trans('trans.answers') }} <span style="color: red; font-size: smaller">
                                                     {{ trans('trans.warning_question') }}</span> </label>
                                                <div class="box">
                                                    <textarea type="text" class="form-control" name="answers"></textarea>
                                                </div>
                                            </div>

                                            <div class="col-12 mt-3">
                                                <label for="description"
                                                    class="mr-sm-2">{{ trans('trans.right_answer') }}</label>
                                                <div class="box">
                                                    <input type="text" name="right_answer" class="form-control">
                                                </div>
                                            </div>

                                            <div class="col mt-3">
                                                <input class="btn btn-danger btn-block w-50 mx-auto" data-repeater-delete
                                                    type="button" value="{{ trans('trans.delete_row') }}" />
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
