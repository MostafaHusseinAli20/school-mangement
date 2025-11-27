<?php

namespace App\Repositories\Teachers\Dashboard;

use App\Interfaces\Teachers\Dashboard\TeacherProfileInterface;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class TeacherProfileRepository implements TeacherProfileInterface
{
    public function index()
    {
        return view('dashboard.pages.teachers.dashboard.profile', [
            'information' => Teacher::findOrFail(auth()->guard('teacher')->user()->id)
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name_ar' => 'nullable|string|max:255',
            'name_en' => 'nullable|string|max:255',
            'password' => 'nullable|string|min:8',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'email' => 'nullable|email|max:255|unique:teachers,email,' . $id,
        ]);

        DB::beginTransaction();

        try {
            $teacher = Teacher::findOrFail($id);

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

            // تحديث الإيميل لو فقط تم إرساله
            if($request->filled('email')) {
                $data['email'] = $request->email;
            }

            // تنفيذ التحديث فقط لو في بيانات
            if (!empty($data)) {
                $teacher->update($data);
            }

            if ($request->hasFile('image')) {
                // حذف الصورة القديمة لو موجودة
                if ($teacher->image && Storage::disk('public')->exists($teacher->image)) {
                    Storage::disk('public')->delete($teacher->image);
                }

                $imagePath = $request->file('image')->store('teachers/images', 'public');
                $teacher->update(['image' => $imagePath]);
            }
            $teacher->save();
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