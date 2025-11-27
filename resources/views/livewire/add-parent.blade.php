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
<div>
    @if (!empty($successMessage))
        <div class="alert alert-success" id="success-alert">
            <button type="button" class="close" data-dismiss="alert">x</button>
            {{ $successMessage }}
        </div>
    @endif

    @if ($catchError)
        <div class="alert alert-danger" id="success-danger">
            <button type="button" class="close" data-dismiss="alert">x</button>
            {{ $catchError }}
        </div>
    @endif
    
    @if ($show_parent)
        @include('livewire.Parent_Table')
    @else

        <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" wire:click="backParentList"
        type="button">{{ trans('trans.back_parent_list') }}
        </button>

        <div class="stepwizard">
            <div class="stepwizard-row setup-panel">
                <div class="stepwizard-step">
                    <a href="#step-1" type="button"
                        class="btn btn-circle {{ $currentStep != 1 ? 'btn-default' : 'btn-success' }}">1</a>
                    <p>{{ trans('trans.father_information') }}</p>
                </div>
                <div class="stepwizard-step">
                    <a href="#step-2" type="button"
                        class="btn btn-circle {{ $currentStep != 2 ? 'btn-default' : 'btn-success' }}">2</a>
                    <p>{{ trans('trans.mother_information') }}</p>
                </div>
                <div class="stepwizard-step">
                    <a href="#step-3" type="button"
                        class="btn btn-circle {{ $currentStep != 3 ? 'btn-default' : 'btn-success' }}"
                        disabled="disabled">3</a>
                    <p>{{ trans('trans.confirm_information') }}</p>
                </div>
            </div>
        </div>

        @include('livewire.Father_Form')
        @include('livewire.Mother_Form')

        <div class="row setup-content {{ $currentStep != 3 ? 'displayNone' : '' }}" id="step-3">

            <div @if ($currentStep != 3) style="display: none" class="row setup-content" id="step-3" @endif>

                <div class="col-xs-12">
                    <div class="col-md-12"><br>
                        <label style="color: red">{{ trans('trans.attachments') }}</label>
                        <div class="form-group">
                            <input type="file" wire:model="photos" accept="image/*" multiple>
                        </div>
                        <br>

                        <input type="hidden" wire:model="parent_id">

                        {{-- <h3>{{ trans('trans.save_data') }}</h3><br> --}}
                        <button class="btn btn-danger btn-sm nextBtn btn-lg pull-right" type="button"
                            wire:click="back(2)">{{ trans('trans.Back') }}</button>
                        @if ($updateMode)
                            <button class="btn btn-success btn-sm nextBtn btn-lg pull-right"
                                wire:click="submitForm_edit" type="button">{{ trans('trans.finish') }}
                            </button>
                        @else
                            <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" wire:click="submitForm"
                                type="button">{{ trans('trans.finish') }}
                            </button>
                            
                        @endif
                    </div>
                </div>
            </div>
    @endif
</div>

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