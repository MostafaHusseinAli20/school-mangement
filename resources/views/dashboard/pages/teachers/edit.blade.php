@extends('dashboard.layouts.master')

@section('title', __('trans.school_mangement_system') . ' | ' . __('trans.edit_teacher'))


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
                            <form action="{{ route('teachers.update', $teachers->id) }}" method="post" 
                                enctype="multipart/form-data">
                                @csrf
                                @method('patch')

                                <div class="d-flex flex-column justify-content-center align-items-center mb-3">
                                    <div class="placeholder-text mb-2">{{ trans('trans.choose_image') }}</div>
                                    <label for="mainImage" class="image-upload-container">
                                        <div class="edit-icon">✎</div>

                                        <img id="previewImage" alt="selected image"
                                            src="{{ $teachers->image ? asset("storage/$teachers->image") : '' }}"
                                            style="{{ $teachers->image ? 'display:block;' : 'display:none;' }}"
                                            alt="teacher image">

                                    </label>

                                    <input type="file" id="mainImage" name="image" accept="image/*"
                                        style="display:none;">
                                </div>

                                <div class="form-row">
                                    <div class="col">
                                        <label for="title">{{ trans('trans.Email') }}</label>
                                        <input type="hidden" value="{{ $teachers->id }}" name="id">
                                        <input type="email" name="email" value="{{ $teachers->email }}"
                                            class="form-control">
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
                                        <input type="text" name="name_teacher_ar"
                                            value="{{ $teachers->getTranslation('name', 'ar') }}" class="form-control">
                                        @error('name_teacher_ar')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <label for="title">{{ trans('trans.name_teacher_en') }}</label>
                                        <input type="text" name="name_teacher_en"
                                            value="{{ $teachers->getTranslation('name', 'en') }}" class="form-control">
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
                                            <option value="{{ $teachers->specialist_id }}">
                                                {{ $teachers->specialisations->name }}</option>
                                            @foreach ($specialisations as $specialization)
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
                                            <option value="{{ $teachers->gender_id }}" selected>
                                                {{ $teachers->genders->name }}</option>
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
                                        <label for="title">{{ trans('trans.grade') }}</label>
                                        <div class='input-group date'>
                                            <select name="grade_id[]" class="custom-select my-1 mr-sm-2" multiple>
                                                <option disabled>{{ trans('trans.Choose') }}...</option>
                                                @foreach ($grades as $grade)
                                                    <option value="{{ $grade->id }}"
                                                        {{ in_array($grade->id, $teacherGrades) ? 'selected' : '' }}>
                                                        {{ $grade->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('grade_id')
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
                                                value="{{ $teachers->joining_data }}" name="joining_data"
                                                data-date-format="yyyy-mm-dd" required>
                                        </div>
                                        @error('joining_data')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <br>

                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">{{ trans('trans.address') }}</label>
                                    <textarea class="form-control" name="address" id="exampleFormControlTextarea1" rows="4">{{ $teachers->address }}</textarea>
                                    @error('address')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <button class="btn btn-success btn-sm nextBtn btn-lg pull-right"
                                    type="submit">{{ trans('trans.Next') }}</button>
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
@endsection
