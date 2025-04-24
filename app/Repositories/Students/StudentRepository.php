<?php

namespace App\Repositories\Students;

use App\Interfaces\Students\StudentInterface;
use App\Models\Classe;
use App\Models\Gender;
use App\Models\Grade;
use App\Models\Image;
use App\Models\MyParent;
use App\Models\Nationality;
use App\Models\Section;
use App\Models\Student;
use App\Models\TypeBlood;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class StudentRepository implements StudentInterface
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::get();
        return view('dashboard.pages.students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['genders'] = Gender::get();
        $data['parents'] = MyParent::get();
        $data['bloods'] = TypeBlood::get();
        $data['nationals'] = Nationality::get();
        $data['grades'] = Grade::get();
        return view('dashboard.pages.students.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($request)
    {
        DB::beginTransaction();
        try {
            $student = Student::create([
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'name' => ['ar' => $request->name_student_ar, 'en' => $request->name_student_en],
                'date_birth' => $request->date_birth,
                'academic_year' => $request->academic_year,
                'gender_id' => $request->gender_id,
                'nationality_id' => $request->nationality_id,
                'type_blood_id' => $request->type_blood_id,
                'grade_id' => $request->grade_id,
                'classe_id' => $request->classe_id,
                'section_id' => $request->section_id,
                'parent_id' => $request->parent_id
            ]);

            if ($request->hasFile('photos')) {
                foreach ($request->file('photos') as $photo) {
                    $name = $photo->getClientOriginalName();
                    $photo->storeAs('students_attachments/' . $student->name, $photo->getClientOriginalName(), 'public');

                    Image::create([
                        'file_name' => $name,
                        'imageable_id' => $student->id,
                        'imageable_type' => 'App\Models\Student'
                    ]);
                }
            }
            DB::commit(); // insert data

            toastr()->success(trans('trans.message_added_student'));
            return redirect()->route('students.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $student = Student::findOrFail($id);
        return view('dashboard.pages.students.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data['genders'] = Gender::get();
        $data['parents'] = MyParent::get();
        $data['bloods'] = TypeBlood::get();
        $data['nationals'] = Nationality::get();
        $data['grades'] = Grade::get();
        $students = Student::findOrFail($id);
        return view('dashboard.pages.students.edit', $data, compact('students'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($request, $id)
    {
        try {
            $student = Student::findOrFail($id);

            $data =
                [
                    'email' => $request->email,
                    'name' => ['ar' => $request->name_student_ar, 'en' => $request->name_student_en],
                    'date_birth' => $request->date_birth,
                    'academic_year' => $request->academic_year,
                    'gender_id' => $request->gender_id,
                    'nationality_id' => $request->nationality_id,
                    'type_blood_id' => $request->type_blood_id,
                    'grade_id' => $request->grade_id,
                    'classe_id' => $request->classe_id,
                    'section_id' => $request->section_id,
                    'parent_id' => $request->parent_id
                ];

            if ($request->filled('password')) {
                $data['password'] = Hash::make($request->password);
            }

            $student->update($data);

            toastr()->success(trans('trans.message_update_student'));
            return redirect()->route('students.index');
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function upload_attachment($request)
    {
        foreach ($request->file('photos') as $photo) {
            $name = $photo->getClientOriginalName();
            $photo->storeAs('students_attachments/' . $request->student_name, $photo->getClientOriginalName(), 'public');

            Image::create([
                'file_name' => $name,
                'imageable_id' => $request->student_id,
                'imageable_type' => 'App\Models\Student'
            ]);
        }
        toastr()->success(trans('trans.message_added_attachment'));
        return redirect()->route('students.show', $request->student_id);
    }

    public function download_attachment($students_name, $file_name)
    {
        $file_path = storage_path("app/public/students_attachments/$students_name/$file_name");

        if (!file_exists($file_path)) {
            toastr()->error(trans('trans.message_no_found_attachment'));
            return back();
        }

        return response()->download($file_path);
    }

    public function delete_attachment($request)
    {
        // Delete img in server disk
        Storage::disk('public')->delete('students_attachments/' . $request->student_name . '/' . $request->file_name);

        // Delete in data
        image::where('id', $request->id)->where('file_name', $request->file_name)->delete();
        toastr()->error(trans('trans.message_delete_attachment'));
        return redirect()->route('students.show', $request->student_id);
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy($id)
    {
        // Delete Image From Server and DB
        $student = Student::findOrFail($id);

        if ($student->images()->exists()) {
            $images = $student->images;

            foreach ($images as $image) {
                Storage::disk('public')->delete("students_attachments/{$student->name_student_ar}");
                $image->delete();
            }
        }

        $student->delete();
        toastr()->error(trans('trans.message_delete_student'));
        return redirect()->route('students.index');
    }

    public function getClasses($id)
    {
        $list_classes = Classe::where("grade_id", $id)->pluck("classe_name", "id");
        return $list_classes;
    }

    public function getSections($id)
    {
        $list_sections = Section::where("classe_id", $id)->pluck("name_section", "id");
        return $list_sections;
    }

    public function show_attachment($student_name, $file_name)
    {
        $file = Storage::disk('public')->path("students_attachments/$student_name/$file_name");

        if (Storage::disk('public')->exists("students_attachments/$student_name/$file_name")) {
            return response()->file($file);
        } else {
            return abort(404, 'File not found.');
        }
    }
}
