<?php

namespace App\Repositories\Parents;

use App\Interfaces\Parents\ParentMainInterface;
use App\Models\FeeInvocie;
use App\Models\Grade;
use App\Models\MyParent;
use App\Models\ReceiptStudent;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ParentMainRepository implements ParentMainInterface
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
            $query->where('students.gender_id', $request->gender)
                ->where('students.parent_id', auth()->guard('parent')->user()->id);
        }

        if ($request->grade && $request->grade != 0) {
            $query->where('students.grade_id', $request->grade)
                ->where('students.parent_id', auth()->guard('parent')->user()->id);
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
        $student_ids = Student::where('parent_id', auth()->guard('parent')->user()->id)->pluck('id');
        $fee_invoices = FeeInvocie::whereIn('student_id', $student_ids)->get();
        return view('dashboard.pages.parents.fees.index',[
            'fee_invoices' => $fee_invoices
        ]);
    }

    public function feesRecipt($id)
    {
        $student = Student::findOrFail($id);
        if($student->parent_id != auth()->guard('parent')->user()->id){
            abort(403, __('trans-parent.message_forbidden'));
        }

        $recipt_students = ReceiptStudent::where('student_id', $id)->get();
        // return $recipt_students;
        return view('dashboard.pages.parents.fees.recipt',[
            'recipt_students' => $recipt_students
        ]);
    }

    public function profile()
    {
        $information = MyParent::findOrFail(auth()->guard('parent')->user()->id);
        return view('dashboard.pages.parents.profile',[
            'information' => $information
        ]);
    }

    public function updateProfile(Request $request, $id)
    {
        $request->validate([
            'name_father_ar' => 'nullable|string|max:255',
            'name_father_en' => 'nullable|string|max:255',
            'password' => 'nullable|string|min:8',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'email' => 'nullable|email|max:255|unique:my_parents,email,'.$id,
        ]);

        DB::beginTransaction();

        try {
            $my_parent = MyParent::findOrFail($id);
            $data = [];

            if ($request->filled('name_father_ar') || $request->filled('name_father_en')) {
                $data['name_father'] = [
                    'ar' => $request->name_father_ar ?? $my_parent->getTranslation('name_father', 'ar'),
                    'en' => $request->name_father_en ?? $my_parent->getTranslation('name_father', 'en'),
                ];
            }

            // تحديث الإيميل لو فقط تم إرساله
            if( $request->filled('email')) {
                $data['email'] = $request->email;
            }

            // تحديث الباسورد لو فقط تم إرساله
            if ($request->filled('password')) {
                $data['password'] = Hash::make($request->password);
            }

            // تنفيذ التحديث فقط لو في بيانات
            if (!empty($data)) {
                $my_parent->update($data);
            }

            if ($request->hasFile('image')) {
                if ($my_parent->image && Storage::disk('public')->exists($my_parent->image)) {
                    Storage::disk('public')->delete($my_parent->image);
                }
                $path = $request->file('image')->store('parents/images', 'public');
                $my_parent->image = $path;
            }
            $my_parent->save();
            DB::commit();

            toastr()->success(trans('trans.message_updated_parent'));
            return redirect()->route('parent.profile');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with(['error' => $e->getMessage()]);
        }
    }
}