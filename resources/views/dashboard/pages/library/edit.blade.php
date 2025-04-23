@extends('dashboard.layouts.master')

@section('title', __('trans.school_mangement_system') . ' | ' . __('trans.edit_book'))

@section('css')
    @toastr_css
@endsection
    
@section('content')
    <!-- row -->
        <div class="row">
            <div class="col-md-12 mb-30">
                <div class="card card-statistics h-100">
                    <div class="card-body">

                        @if(session()->has('error'))
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
                                <form action="{{route('library.update',$book->id)}}" method="post" autocomplete="off" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <div class="form-row">
                                        <div class="col">
                                            <label for="title">{{ trans('trans.book_name') }}</label>
                                            <input type="text" name="title"
                                                value="{{ $book->title }}"
                                                class="form-control">
                                            <input type="hidden" name="id" value="{{$book->id}}">
                                        </div>

                                        <div class="col-md-12 my-3">

                                            <p class="bg-secondary text-success py-2 pl-4 w-50 mx-auto" style="font-weight: bold; font-size: 17px">
                                                الملف المحفوظ الان: {{ $book->file_name }}
                                            </p>

                                            <label for="file_name">{{ trans('trans.file_book') }}</label>
                                            <input type="file" name="file_name" class="form-control">
                                        </div>

                                    </div>
                                    <br>

                                    <div class="form-row">
                                        <div class="form-group col">
                                            <label for="inputState">{{ trans('trans.grade') }}</label>
                                            <select class="custom-select my-1 mr-sm-2" name="grade_id">
                                                <option selected disabled>{{trans('trans.Choose')}}...</option>
                                                @foreach($grades as $grade)
                                                    <option
                                                        value="{{$grade->id}}" {{$grade->id == $book->grade_id ?'selected':''}}>{{$grade->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group col">
                                            <label for="inputState">{{ trans('trans.acadmy_classe') }}</label>
                                            <select name="classe_id" class="custom-select">
                                                <option
                                                    value="{{ $book->classe->id }}">{{ $book->classe->classe_name }}
                                                </option>
                                            </select>
                                        </div>

                                        <div class="form-group col">
                                            <label for="inputState">{{ trans('trans.section') }}</label>
                                            <select name="section_id" class="custom-select">
                                                <option
                                                    value="{{ $book->section->id }}">{{ $book->section->name_section }}
                                                </option>
                                            </select>
                                        </div>

                                        <div class="form-group col">
                                            <label for="inputState">{{ trans('trans.name_teacher') }}</label>
                                            <select class="custom-select my-1 mr-sm-2" name="teacher_id">
                                                <option selected disabled>{{trans('trans.Choose')}}...</option>
                                                @foreach($teachers as $teacher)
                                                    <option
                                                        value="{{$teacher->id}}" {{$teacher->id == $book->teacher_id ?'selected':''}}>{{$teacher->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit">
                                        {{ trans('save') }}
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
    <script>
        $(document).ready(function () {
            $('select[name="grade_id"]').on('change', function () {
                var grade_id = $(this).val();
                if (grade_id) {
                    $.ajax({
                        url: "{{ URL::to('classes') }}/" + grade_id,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            $('select[name="classe_id"]').empty();
                            $.each(data, function (key, value) {
                                $('select[name="classe_id"]').append('<option value="' + key + '">' + value + '</option>');
                            });
                        },
                    });
                } else {
                    console.log('AJAX load did not work');
                }
            });
        });
    </script>

    <script>
        $(document).ready(function () {
            $('select[name="classe_id"]').on('change', function () {
                var Classroom_id = $(this).val();
                if (Classroom_id) {
                    $.ajax({
                        url: "{{ URL::to('get_sections') }}/" + Classroom_id,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            $('select[name="section_id"]').empty();
                            $.each(data, function (key, value) {
                                $('select[name="section_id"]').append('<option value="' + key + '">' + value + '</option>');
                            });

                        },
                    });
                }

                else {
                    console.log('AJAX load did not work');
                }
            });
        });
    </script>
@endsection
