<?php

namespace App\Repositories\Students;

use App\Interfaces\Students\StudentInterface;
use App\Models\Classe;
use App\Models\Gender;
use App\Models\Grade;
use App\Models\MyParent;
use App\Models\Nationality;
use App\Models\Section;
use App\Models\Student;
use App\Models\TypeBlood;
use Illuminate\Support\Facades\Hash;

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
        try {
            Student::create([
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
            toastr()->success(trans('trans.message_added_student'));
            return redirect()->route('students.index');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $student = Student::findOrFail($id);
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
}
