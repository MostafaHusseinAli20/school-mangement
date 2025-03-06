<div @if ($currentStep != 1) style="display: none" class="row setup-content" id="step-1" @endif>

    <div class="col-xs-12">
        <div class="col-md-12">
            <br>
            <div class="form-row">
                <div class="col">
                    <label for="title">{{ trans('trans.Email') }}</label>
                    <input type="email" wire:model="email" class="form-control">
                    @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col">
                    <label for="title">{{ trans('trans.Password') }}</label>
                    <input type="password" wire:model="password" class="form-control">
                    @error('password')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="col">
                    <label for="title">{{ trans('trans.Name_Father') }}</label>
                    <input type="text" wire:model="name_father" class="form-control">
                    @error('name_father')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col">
                    <label for="title">{{ trans('trans.Name_Father_en') }}</label>
                    <input type="text" wire:model="name_father_en" class="form-control">
                    @error('name_father_en')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="col-md-3">
                    <label for="title">{{ trans('trans.Job_Father') }}</label>
                    <input type="text" wire:model="job_father" class="form-control">
                    @error('job_father')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-3">
                    <label for="title">{{ trans('trans.Job_Father_en') }}</label>
                    <input type="text" wire:model="job_father_en" class="form-control">
                    @error('job_father_en')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col">
                    <label for="title">{{ trans('trans.National_ID_Father') }}</label>
                    <input type="text" wire:model="national_ID_father" class="form-control">
                    @error('national_ID_father')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col">
                    <label for="title">{{ trans('trans.Passport_ID_Father') }}</label>
                    <input type="text" wire:model="passport_ID_father" class="form-control">
                    @error('passport_ID_father')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col">
                    <label for="title">{{ trans('trans.Phone_Father') }}</label>
                    <input type="text" wire:model="phone_father" class="form-control">
                    @error('phone_father')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputCity">{{ trans('trans.Nationality_Father_id') }}</label>
                    <select class="custom-select my-1 mr-sm-2" wire:model="nationality_father_id">
                        <option selected>{{ trans('trans.Choose') }}...</option>
                        @foreach ($Nationalities as $National)
                            <option value="{{ $National->id }}">{{ $National->name }}</option>
                        @endforeach
                    </select>
                    @error('nationality_father_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col">
                    <label for="inputState">{{ trans('trans.Blood_Type_Father_id') }}</label>
                    <select class="custom-select my-1 mr-sm-2" wire:model="blood_type_father_id">
                        <option selected>{{ trans('trans.Choose') }}...</option>
                        @foreach ($Type_Bloods as $Type_Blood)
                            <option value="{{ $Type_Blood->id }}">{{ $Type_Blood->name }}</option>
                        @endforeach
                    </select>
                    @error('blood_type_father_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col">
                    <label for="inputZip">{{ trans('trans.Religion_Father_id') }}</label>
                    <select class="custom-select my-1 mr-sm-2" wire:model="religion_father_id">
                        <option selected>{{ trans('trans.Choose') }}...</option>
                        @foreach ($Religions as $Religion)
                            <option value="{{ $Religion->id }}">{{ $Religion->name }}</option>
                        @endforeach
                    </select>
                    @error('religion_father_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>


            <div class="form-group">
                <label for="exampleFormControlTextarea1">{{ trans('trans.Address_Father') }}</label>
                <textarea class="form-control" wire:model="address_father" id="exampleFormControlTextarea1" rows="4"></textarea>
                @error('address_father')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            @if ($updateMode)
                <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" wire:click="firstStepSubmit_edit"
                type="button">{{ trans('trans.Next') }}
                </button>
            @else
                <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" wire:click="firstStepSubmit"
                type="button">{{ trans('trans.Next') }}
                </button>
            @endif
        </div>
    </div>
</div>
