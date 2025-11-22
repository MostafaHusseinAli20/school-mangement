<?php

namespace App\Http\Controllers\Dashboard\Parent\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Grade;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ParentMainController extends Controller
{
    public function index()
    {
        $sons = Student::where('parent_id', auth()->guard('parent')->user()->id)->get();
            
        return view('dashboard.pages.parents.index',[
            'sons' => $sons
        ]);
    }

    public function grades()
    {
        return view('dashboard.pages.parents.grades.index',[
            'grades' => Grade::get()
        ]);
    }

    public function children()
    {
        return view('dashboard.pages.parents.children.index',[
            'sons' => Student::where('parent_id', auth()->guard('parent')->user()->id)->get(),
            'grades' => Grade::get()
        ]);
    }

    public function filterChildern(Request $request)
    {
        // Query Builder
        $query = DB::table('students')
            ->leftJoin('type_bloods', 'type_bloods.id', '=', 'students.type_blood_id')
            ->leftJoin('genders', 'genders.id', '=', 'students.gender_id')
            ->leftJoin('grades', 'grades.id', '=', 'students.grade_id')
            ->leftJoin('classes', 'classes.id', '=', 'students.classe_id')
            ->leftJoin('sections', 'sections.id', '=', 'students.section_id')
            ->select(
                'students.*',
                'type_bloods.name as type_blood_name',
                'genders.name as gender_name',
                'grades.name as grade_name',
                'classes.classe_name as class_name',
                'sections.name_section as section_name'
            );

        if ($request->gender && $request->gender != 0) {
            $query->where('students.gender_id', $request->gender);
        }

        if ($request->grade && $request->grade != 0) {
            $query->where('students.grade_id', $request->grade);
        }

        $sons = $query->get();

        $sons = $query->get()->map(function ($item) {
            // حول الأعمدة المترجمة من JSON string إلى array
            $item->name = json_decode($item->name, true);
            $item->gender_name = json_decode($item->gender_name, true);
            $item->grade_name = json_decode($item->grade_name, true);
            $item->class_name = json_decode($item->class_name, true);
            $item->section_name = json_decode($item->section_name, true);

            return $item;
        });

        return response()->json([
            'data' => $sons
        ]);
    }

    public function fees()
    {
        return view('dashboard.pages.parents.fees.index');
    }

    public function profile()
    {
        return view('dashboard.pages.parents.profile');
    }
}
