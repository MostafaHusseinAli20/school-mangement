@extends('dashboard.layouts.master')
@section('title', __('trans.school_mangement_system') . ' | ' . __('trans.profile'))

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
    <div class="card-body">

        <section style="background-color: #eee;">
            <div class="row">
                
                <div class="col-lg-12">
                    <div class="card mb-4">
                        <div class="card-body">
                            <form action="{{ route('profile.update', $information->id) }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                 <div class="d-flex flex-column justify-content-center align-items-center mb-3">
                                <div class="placeholder-text mb-2">{{ trans('trans.choose_image') }}</div>
                                <label for="mainImage" class="image-upload-container">
                                    <div class="edit-icon">✎</div>

                                    <img id="previewImage" alt="selected image"
                                        src="{{ $information->image ? asset("storage/$information->image") : asset('assets/images/admin.png') }}"
                                        style="display: {{ $information->image || asset('assets/images/admin.png') ? 'block' : 'none' }}" 
                                        alt="admin image"
                                    >
                                </label>
                                <input type="file" id="mainImage" name="image" accept="image/*" style="display:none;">
                            </div>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-2">{{ trans('trans.name') }}</p>
                                    </div>
                                    <div class="col-sm-12">
                                        <p class="text-muted mb-0">
                                            <input type="text" name="name" value="{{ $information->name }}"
                                                class="form-control">
                                        </p>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-2">{{ trans('trans.Email') }}</p>
                                    </div>
                                    <div class="col-sm-12">
                                        <p class="text-muted mb-0">
                                            <input type="email" name="email" value="{{ $information->email }}"
                                                class="form-control">
                                        </p>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-2">{{ trans('trans.Password') }}</p>
                                    </div>
                                    <div class="col-sm-12">
                                        <p class="text-muted mb-2">
                                            <input type="password" id="password" class="form-control" name="password">
                                        </p><br>
                                        <input type="checkbox" class="form-check-input ml-1" onclick="myFunction()"
                                            id="exampleCheck1">
                                        <label class="form-check-label ml-4"
                                            for="exampleCheck1">{{ trans('trans.show_password') }}</label>
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
