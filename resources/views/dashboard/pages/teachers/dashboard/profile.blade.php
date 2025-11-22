@extends('dashboard.layouts.master')
@section('title', __('trans.school_mangement_system') . " | " 
    . __('trans.profile'))

@section('css')
    @toastr_css
@endsection

@section('content')
    <div class="card-body">

        <section style="background-color: #eee;">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card mb-4">
                        <div class="card-body text-center">
                            <img src="{{ asset('assets/images/teacher.png') }}"
                                 alt="avatar"
                                 class="rounded-circle img-fluid" style="width: 150px;">
                            <h5 style="font-family: Cairo" class="my-3">{{$information->name}}</h5>
                            <p class="text-muted mb-1">{{$information->email}}</p>
                            <p class="text-muted mb-4">{{ trans('trans.teacher') }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card mb-4">
                        <div class="card-body">
                            <form action="{{route('teacher.profile.update',$information->id)}}" method="post">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">{{ trans('trans.teacher_name_ar') }}</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-muted mb-0">
                                            <input type="text" name="name_ar"
                                                   value="{{ $information->getTranslation('name', 'ar') }}"
                                                   class="form-control">
                                        </p>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">{{ trans('trans.teacher_name_en') }}</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-muted mb-0">
                                            <input type="text" name="name_en"
                                                   value="{{ $information->getTranslation('name', 'en') }}"
                                                   class="form-control">
                                        </p>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">{{ trans('trans.Password') }}</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-muted mb-0">
                                            <input type="password" id="password" class="form-control" name="password">
                                        </p><br><br>
                                        <input type="checkbox" class="form-check-input" onclick="myFunction()"
                                               id="exampleCheck1">
                                        <label class="form-check-label" for="exampleCheck1">{{ trans('trans.show_password') }}</label>
                                    </div>
                                </div>
                                <hr>
                                <button type="submit" class="btn btn-success">{{ trans('trans.update_data') }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- row closed -->
@endsection

@section('js')
    @toastr_js
    @toastr_render
    <script>
        function myFunction() {
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>
@endsection