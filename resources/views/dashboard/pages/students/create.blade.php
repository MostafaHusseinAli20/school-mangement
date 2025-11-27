@extends('dashboard.layouts.master')

@section('title', __('trans.school_mangement_system') . ' | ' . __('trans.add_student'))

@section('css')
    @toastr_css
    <style>
        .image-upload-container {
            width: 130px;
            height: 130px;
            border: 2px dashed #ddd;
            border-radius: 12px;
            position: relative;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            background: #f8f8f8;
            transition: 0.3s;
        }

        .image-upload-container:hover {
            border-color: #aaa;
        }

        .image-upload-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: none;
            /* هتظهر بعد الاختيار */
        }

        .edit-icon {
            position: absolute;
            top: -3px;
            left: -3px;
            background: #555;
            color: white;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            cursor: pointer;
            z-index: 2;
        }

        .edit-icon:hover {
            background: #333;
        }

        .placeholder-text {
            font-size: 14px;
            color: #666;
            margin-top: 8px;
            text-align: center;
        }
    </style>
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

                    <form method="post" action="{{ route('students.store') }}" autocomplete="off"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="d-flex flex-column justify-content-center align-items-center mb-3">
                            <div class="placeholder-text mb-2">{{ trans('trans.choose_image') }}</div>
                            <label for="mainImage" class="image-upload-container">
                                <div class="edit-icon">✎</div>

                                <img id="previewImage" alt="selected image">

                            </label>

                            <input type="file" id="mainImage" name="image" accept="image/*" style="display:none;">
                        </div>

                        <h6 style="font-family: 'Cairo', sans-serif;color: blue">{{ trans('trans.personal_information') }}
                        </h6><br>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{ trans('trans.name_student_ar') }} : <span class="text-danger">*</span></label>
                                    <input type="text" name="name_student_ar" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{ trans('trans.name_student_en') }} : <span class="text-danger">*</span></label>
                                    <input class="form-control" name="name_student_en" type="text">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{ trans('trans.Email') }} : </label>
                                    <input type="email" name="email" class="form-control">
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{ trans('trans.Password') }} :</label>
                                    <input type="password" name="password" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="gender">{{ trans('trans.gender') }} : <span
                                            class="text-danger">*</span></label>
                                    <select class="custom-select mr-sm-2" name="gender_id">
                                        <option selected disabled>{{ trans('trans.Choose') }}...</option>
                                        @foreach ($genders as $gender)
                                            <option value="{{ $gender->id }}">{{ $gender->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="nal_id">{{ trans('trans.nationality') }} : <span
                                            class="text-danger">*</span></label>
                                    <select class="custom-select mr-sm-2" name="nationality_id">
                                        <option selected disabled>{{ trans('trans.Choose') }}...</option>
                                        @foreach ($nationals as $national)
                                            <option value="{{ $national->id }}">{{ $national->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="bg_id">{{ trans('trans.blood_type') }} : </label>
                                    <select class="custom-select mr-sm-2" name="type_blood_id">
                                        <option selected disabled>{{ trans('trans.Choose') }}...</option>
                                        @foreach ($bloods as $blood)
                                            <option value="{{ $blood->id }}">{{ $blood->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>{{ trans('trans.date_of_birth') }} :</label>
                                    <input class="form-control" type="text" id="datepicker-action" name="date_birth"
                                        data-date-format="yyyy-mm-dd">
                                </div>
                            </div>

                        </div>

                        <h6 style="font-family: 'Cairo', sans-serif;color: blue">{{ trans('trans.Student_information') }}
                        </h6><br>
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="grade_id">{{ trans('trans.grade') }} : <span
                                            class="text-danger">*</span></label>
                                    <select class="custom-select mr-sm-2" name="grade_id">
                                        <option selected disabled>{{ trans('trans.Choose') }}...</option>
                                        @foreach ($grades as $grade)
                                            <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="classes">{{ trans('trans.classes') }} : <span
                                            class="text-danger">*</span></label>
                                    <select class="custom-select mr-sm-2" name="classe_id">

                                    </select>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="section_id">{{ trans('trans.section') }} : </label>
                                    <select class="custom-select mr-sm-2" name="section_id">

                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="parent_id">{{ trans('trans.parent') }} : <span
                                            class="text-danger">*</span></label>
                                    <select class="custom-select mr-sm-2 select2" name="parent_id">
                                        <option selected disabled>{{ trans('trans.Choose') }}...</option>
                                        @foreach ($parents as $parent)
                                            <option value="{{ $parent->id }}">{{ $parent->name_father }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="academic_year">{{ trans('trans.study_year') }} : <span
                                            class="text-danger">*</span></label>
                                    <select class="custom-select mr-sm-2" name="academic_year">
                                        <option selected disabled>{{ trans('trans.Choose') }}...</option>
                                        @php
                                            $current_year = date('Y');
                                        @endphp
                                        @for ($year = $current_year; $year <= $current_year + 1; $year++)
                                            <option value="{{ $year }}">{{ $year }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="academic_year">{{ trans('trans.attachments') }} : <span
                                            class="text-danger">*</span></label>
                                    <input type="file" accept="image/*" name="photos[]" multiple>
                                </div>
                            </div>

                        </div><br>
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
    <script>
        document.getElementById("mainImage").addEventListener("change", function(event) {
            const file = event.target.files[0];
            const preview = document.getElementById("previewImage");

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.style.display = "block";
                    preview.src = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
@endsection
