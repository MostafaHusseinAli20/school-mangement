<?php

namespace App\Repositories\Students\Dashboard;

use App\Interfaces\Students\StudentProfileInterface;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

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
            'email' => 'nullable|email|max:255|unique:students,email,' . $id,
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        DB::beginTransaction();

        try {
            $student = Student::findOrFail($id);

            // نبدأ نبني البيانات اللي هنتحدثها
            $data = [];

            // تحديث الاسم فقط لو فيه حاجة متغيرة
            if ($request->filled('name_ar') || $request->filled('name_en')) {
                $data['name'] = [
                    'ar' => $request->name_ar ?? $student->getTranslation('name', 'ar'),
                    'en' => $request->name_en ?? $student->getTranslation('name', 'en'),
                ];
            }

            // تحديث الباسورد لو فقط تم إرساله
            if ($request->filled('password')) {
                $data['password'] = Hash::make($request->password);
            }

            if($request->filled('email')) {
                $data['email'] = $request->email;
            }

            // تنفيذ التحديث فقط لو في بيانات
            if (!empty($data)) {
                $student->update($data);
            }

            if($request->hasFile('image')) {
                if($student->image && Storage::disk('public')->exists($student->image)) {
                    // حذف الصورة القديمة لو موجودة
                    Storage::disk('public')->delete($student->image);
                }
                // تخزين الصورة الجديدة
                $imagePath = $request->file('image')->store('students/images', 'public');
                $student->image = $imagePath;
            }
            $student->save();
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