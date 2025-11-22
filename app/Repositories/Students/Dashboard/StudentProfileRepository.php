<?php

namespace App\Repositories\Students\Dashboard;

use App\Interfaces\Students\StudentProfileInterface;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class StudentProfileRepository implements StudentProfileInterface
{
    public function index()
    {
        return view('dashboard.pages.students.dashboard.profile.index', [
            'information' => Student::findOrFail(auth()->guard('student')->user()->id),
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name_ar' => 'nullable|string|max:255',
            'name_en' => 'nullable|string|max:255',
            'password' => 'nullable|string|min:8',
        ]);

        DB::beginTransaction();

        try {
            $teacher = Student::findOrFail($id);

            // نبدأ نبني البيانات اللي هنتحدثها
            $data = [];

            // تحديث الاسم فقط لو فيه حاجة متغيرة
            if ($request->filled('name_ar') || $request->filled('name_en')) {
                $data['name'] = [
                    'ar' => $request->name_ar ?? $teacher->getTranslation('name', 'ar'),
                    'en' => $request->name_en ?? $teacher->getTranslation('name', 'en'),
                ];
            }

            // تحديث الباسورد لو فقط تم إرساله
            if ($request->filled('password')) {
                $data['password'] = Hash::make($request->password);
            }

            // تنفيذ التحديث فقط لو في بيانات
            if (!empty($data)) {
                $teacher->update($data);
            }

            DB::commit();

            toastr()->success(trans('trans.message_updated_teacher'));
            return redirect()->route('teachers.profile');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e);
            return redirect()->back()->with(['error' => trans('trans.something_went_wrong')]);
        }
    }
}