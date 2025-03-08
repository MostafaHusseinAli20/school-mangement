<?php

namespace App\Repositories\Teachers;

use App\Interfaces\Teachers\TeacherInterface;
use App\Models\Gender;
use App\Models\Specialisation;
use App\Models\Teacher;
use App\Repositories\Grades\GradeRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class TeacherRepository implements TeacherInterface
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teachers = Teacher::get();
        return view('dashboard.pages.teachers.index', compact('teachers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $genders = Gender::get();
        $specializations = Specialisation::get();
        return view('dashboard.pages.teachers.create', compact('genders', 'specializations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($request)
    {
        try {
            Teacher::create([
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'name' => ['en' => $request->name_teacher_en, 'ar' => $request->name_teacher_ar],
                'joining_data' => $request->joining_data,
                'gender_id' => $request->gender_id,
                'specialist_id' => $request->specialist_id,
                'address' => $request->address,
            ]);

            toastr()->success(trans('trans.message_added_teacher'));
            return redirect()->route('teachers.index');
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
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
        $teachers = Teacher::findOrFail($id);
        $specialisations = Specialisation::get();
        $genders = Gender::get();
        return view('dashboard.pages.teachers.edit', compact('teachers', 'specialisations', 'genders'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($request, $id)
    {
        try {
            $teacher = Teacher::findOrFail($id);

            $data = 
            [
                'email' => $request->email,
                'name' => ['ar' => $request->name_teacher_ar, 'en' => $request->name_teacher_en],
                'address' => $request->address,
                'specialist_id' => $request->specialist_id,
                'gender_id' => $request->gender_id
            ];

            if ($request->filled('password')) {
                $data['password'] = Hash::make($request->password);
            }

            $teacher->update($data);

            toastr()->success(trans('trans.message_updated_teacher'));
            return redirect()->route('teachers.index');
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $teacher = Teacher::findOrFail($id);
        $teacher->delete();
        toastr()->error(trans('trans.message_deleted_teacher'));
        return redirect()->route('teachers.index');
    }
}
