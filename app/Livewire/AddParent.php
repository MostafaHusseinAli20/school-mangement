<?php

namespace App\Livewire;

use App\Models\MyParent;
use App\Models\Nationality;
use App\Models\ParentAttachment;
use App\Models\Religion;
use App\Models\TypeBlood;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class AddParent extends Component
{
    use WithFileUploads;

    public $updateMode = false, $show_parent = true;
    public $successMessage = '';
    public $catchError, $photos, $parent_id;

    public $currentStep = 1;

    // Father_INPUTS
    public $email, $password;
    public $name_father, $name_father_en;
    public $national_ID_father, $passport_ID_father;
    public $phone_father, $job_father, $job_father_en;
    public $nationality_father_id, $blood_type_father_id;
    public $address_father, $religion_father_id;

    // Mother_INPUTS
    public $name_mother, $name_mother_en;
    public $national_ID_mother, $passport_ID_mother;
    public $phone_mother, $job_mother, $job_mother_en;
    public $nationality_mother_id, $blood_type_mother_id;
    public $address_mother, $religion_mother_id;

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'email' => 'required|email',
            'national_ID_father' => 'required|string|min:10|max:10|regex:/^\d{10}$/',
            'passport_ID_father' => 'nullable|min:10|max:10',
            'phone_father' => 'regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'national_ID_mother' => 'required|string|min:10|max:10|regex:/^\d{10}$/',
            'passport_ID_mother' => 'nullable|min:10|max:10',
            'phone_mother' => 'regex:/^([0-9\s\-\+\(\)]*)$/|min:10'
        ]);
    }

    public function render()
    {
        return view('livewire.add-parent', [
            'Nationalities' => Nationality::all(),
            'Type_Bloods' => TypeBlood::all(),
            'Religions' => Religion::all(),
            'my_parents' => MyParent::all(),
        ]);
    }

    //firstStepSubmit
    public function firstStepSubmit()
    {
        $this->validate([
            'email' => 'required|unique:my_parents,email,',
            'password' => 'required',
            'name_father' => 'required',
            'name_father_en' => 'required',
            'job_father' => 'required',
            'job_father_en' => 'required',
            'national_ID_father' => 'required|unique:my_parents,national_ID_father,',
            'passport_ID_father' => 'required|unique:my_parents,passport_ID_father,',
            'phone_father' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'nationality_father_id' => 'required',
            'blood_type_father_id' => 'required',
            'religion_father_id' => 'required',
            'address_father' => 'required',
        ]);

        $this->currentStep = 2;
    }

    //secondStepSubmit
    public function secondStepSubmit()
    {
        $this->validate([
            'name_mother' => 'required',
            'name_mother_en' => 'required',
            'job_mother' => 'required',
            'job_mother_en' => 'required',
            'national_ID_mother' => 'required|unique:my_parents,national_ID_mother,',
            'passport_ID_mother' => 'required|unique:my_parents,passport_ID_mother,',
            'phone_mother' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'nationality_mother_id' => 'required',
            'blood_type_mother_id' => 'required',
            'religion_mother_id' => 'required',
            'address_mother' => 'required',
        ]);

        $this->currentStep = 3;
    }

    public function submitForm()
    {

        try {
            $My_Parent = new MyParent();
            // Father_INPUTS
            $My_Parent->email = $this->email;
            $My_Parent->password = Hash::make($this->password);
            $My_Parent->name_father = ['en' => $this->name_father_en, 'ar' => $this->name_father];
            $My_Parent->national_ID_father = $this->national_ID_father;
            $My_Parent->passport_ID_father = $this->passport_ID_father;
            $My_Parent->phone_father = $this->phone_father;
            $My_Parent->job_father = ['en' => $this->job_father_en, 'ar' => $this->job_father];
            // $My_Parent->passport_ID_father = $this->passport_ID_father;
            $My_Parent->nationality_father_id = $this->nationality_father_id;
            $My_Parent->blood_type_father_id = $this->blood_type_father_id;
            $My_Parent->religion_father_id = $this->religion_father_id;
            $My_Parent->address_father = $this->address_father;

            // Mother_INPUTS
            $My_Parent->name_mother = ['en' => $this->name_mother_en, 'ar' => $this->name_mother];
            $My_Parent->national_ID_mother = $this->national_ID_mother;
            $My_Parent->passport_ID_mother = $this->passport_ID_mother;
            $My_Parent->phone_mother = $this->phone_mother;
            $My_Parent->job_mother = ['en' => $this->job_mother_en, 'ar' => $this->job_mother];
            $My_Parent->passport_ID_mother = $this->passport_ID_mother;
            $My_Parent->nationality_mother_id = $this->nationality_mother_id;
            $My_Parent->blood_type_mother_id = $this->blood_type_mother_id;
            $My_Parent->religion_mother_id = $this->religion_mother_id;
            $My_Parent->address_mother = $this->address_mother;

            $My_Parent->save();

            if (!empty($this->photos)) {
                foreach ($this->photos as $photo) {

                    $photo->storeAs("parents_attachments/$this->national_ID_father", $photo->getClientOriginalName(), 'public');

                    ParentAttachment::create([
                        'file_name' => $photo->getClientOriginalName(),
                        'parent_id' => MyParent::latest()->first()->id,
                    ]);
                }
            }

            $this->successMessage = trans('trans.success');
            $this->clearForm();
            $this->currentStep = 1;
        } catch (\Exception $e) {
            $this->catchError = $e->getMessage();
        };
    }

    public function clearForm()
    {
        $this->email = '';
        $this->password = '';
        $this->name_father = '';
        $this->job_father = '';
        $this->job_father_en = '';
        $this->name_father_en = '';
        $this->national_ID_father = '';
        $this->passport_ID_father = '';
        $this->phone_father = '';
        $this->nationality_father_id = '';
        $this->blood_type_father_id = '';
        $this->address_father = '';
        $this->religion_father_id = '';

        $this->name_mother = '';
        $this->job_mother = '';
        $this->job_mother_en = '';
        $this->name_mother_en = '';
        $this->national_ID_mother = '';
        $this->passport_ID_mother = '';
        $this->phone_mother = '';
        $this->nationality_mother_id = '';
        $this->blood_type_mother_id = '';
        $this->address_mother = '';
        $this->religion_mother_id = '';
    }

    public function showformadd()
    {
        $this->show_parent = false;
    }
    public function backParentList()
    {
        $this->show_parent = true;
    }

    public function firstStepSubmit_edit()
    {
        $this->updateMode = true;
        $this->currentStep = 2;
    }

    public function secondStepSubmit_edit()
    {
        $this->updateMode = true;
        $this->currentStep = 3;
    }

    public function edit($id)
    {
        $this->show_parent = false;
        $this->updateMode = true;

        // Parent Information
        $My_Parent = MyParent::where('id', $id)->first();
        $this->parent_id = $id;
        $this->email = $My_Parent->email;
        $this->password = $My_Parent->password;

        // Father Information
        $this->name_father = $My_Parent->getTranslation('name_father', 'ar');
        $this->name_father_en = $My_Parent->getTranslation('name_father', 'en');
        $this->job_father = $My_Parent->getTranslation('job_father', 'ar');;
        $this->job_father_en = $My_Parent->getTranslation('job_father', 'en');
        $this->national_ID_father = $My_Parent->national_ID_father;
        $this->passport_ID_father = $My_Parent->passport_ID_father;
        $this->phone_father = $My_Parent->phone_father;
        $this->nationality_father_id = $My_Parent->nationality_father_id;
        $this->blood_type_father_id = $My_Parent->blood_type_father_id;
        $this->address_father = $My_Parent->address_father;
        $this->religion_father_id = $My_Parent->religion_father_id;

        // Mother Information
        $this->name_mother = $My_Parent->getTranslation('name_mother', 'ar');
        $this->name_mother_en = $My_Parent->getTranslation('name_mother', 'en');
        $this->job_mother = $My_Parent->getTranslation('job_mother', 'ar');;
        $this->job_mother_en = $My_Parent->getTranslation('job_mother', 'en');
        $this->national_ID_mother = $My_Parent->national_ID_mother;
        $this->passport_ID_mother = $My_Parent->passport_ID_mother;
        $this->phone_mother = $My_Parent->phone_mother;
        $this->nationality_mother_id = $My_Parent->nationality_mother_id;
        $this->blood_type_mother_id = $My_Parent->blood_type_mother_id;
        $this->address_mother = $My_Parent->address_mother;
        $this->religion_mother_id = $My_Parent->religion_mother_id;
    }

    public function submitForm_edit()
    {
        if ($this->parent_id) {
            $parent = MyParent::find($this->parent_id);
            $parent->update([
                'name_father' => ['ar' => $this->name_father, 'en' => $this->name_father_en],
                'national_ID_father' => $this->national_ID_father,
                'passport_ID_father' => $this->passport_ID_father,
            ]);

            return redirect()->to(LaravelLocalization::getCurrentLocale() . '/add_parent');
        }
    }

    public function delete($id) 
    {
        $parent =  MyParent::findOrFail($id);
        $folder_path = "$parent->national_ID_father";

        if (Storage::disk('public')->exists($folder_path)) {
            Storage::disk('public')->deleteDirectory($folder_path);
        }

        $parent->delete();
        return redirect()->to(LaravelLocalization::getCurrentLocale() . '/add_parent');
    }

    //back
    public function back($step)
    {
        $this->currentStep = $step;
    }
}
