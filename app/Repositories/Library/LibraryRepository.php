<?php

namespace App\Repositories\Library;

use App\Interfaces\Library\LibraryInterface;
use App\Models\Classe;
use App\Models\Grade;
use App\Models\Library;
use App\Models\Teacher;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class LibraryRepository implements LibraryInterface
{
    public function index()
    {
        $books = Library::get();
        return view('dashboard.pages.library.index', compact('books'));
    }
    
    public function create()
    {
        $grades = Grade::get();
        $teachers = Teacher::get();
        return view('dashboard.pages.library.create', compact('grades','teachers'));
    }
    
    public function store($request)
    {
        DB::beginTransaction();
        try {
            $file_name = $request->file('file_name')->getClientOriginalName();
            $save_fileName = $request->file('file_name')->storeAs('library_attachment',$file_name, 'public');

            Library::create([
                'title' => $request->title,
                'file_name' => $save_fileName,
                'grade_id' => $request->grade_id,
                'classe_id' => $request->classe_id,
                'section_id' => $request->section_id,
                'teacher_id' => $request->teacher_id,
            ]);

            DB::commit();
            toastr()->success(__('trans.message_added_library'));
            return redirect()->route('library.index');
        } catch (\Exception $e) {
            DB::rollBack();
            toastr()->error($e->getMessage());
            return back();
        }
    }
    
    public function show($filename)
    {
        
    }
    
    public function edit($id)
    {
        $book = Library::findOrFail($id);
        $grades = Grade::get();
        $teachers = Teacher::get();
        $classrooms = Classe::get();
        return view('dashboard.pages.library.edit', compact(
            'book',
            'grades',
                       'teachers',
                       'classrooms'
        ));
    }
    
    public function update($request, $id)
    {
        DB::beginTransaction();
        try {
            $library = Library::findOrFail($id);
    
            // التحقق إذا تم رفع صورة جديدة
            if ($request->hasFile('file_name')) {
                // حذف الصورة القديمة لو موجودة

                if ($library->file_name && Storage::disk('public')->exists($library->file_name)) {
                    Storage::disk('public')->delete($library->file_name);
                }

                $file_name = $request->file('file_name')->getClientOriginalName();
                $save_fileName = $request->file('file_name')->storeAs('library_attachment', $file_name, 'public');
            } else {
                // الحفاظ على اسم الملف القديم إذا لم يتم رفع جديد
                $save_fileName = $library->file_name;
            }

            // تحديث البيانات
            $library->update([
                'title' => $request->title,
                'file_name' => $save_fileName,
                'grade_id' => $request->grade_id,
                'classe_id' => $request->classe_id,
                'section_id' => $request->section_id,
                'teacher_id' => $request->teacher_id,
            ]);
    
            DB::commit();
            toastr()->success(__('trans.message_updated_library'));
            return redirect()->route('library.index');
        } catch (\Exception $e) {
            DB::rollBack();
            toastr()->error($e->getMessage());
            return back();
        }
    }
    
    public function destroy($id)
    {
        
        $library = Library::findOrFail($id);
        $filePath = "$library->file_name";

        if(Storage::disk('public')->exists($filePath))
        {
            Storage::disk('public')->delete($filePath);
        }

        $library->delete();
        toastr()->success(__('trans.message_deleted_library'));
        return back();
    }

    public function download($filename)
    {
        $path = storage_path('app/public/library_attachment/' . $filename);

        if (!file_exists($path)) {
            abort(404, 'الملف غير موجود.');
        }

        return response()->download($path);
    }

    public function open_file($filename)
    {
        $fileName = basename($filename);
        $path = storage_path('app/public/library_attachment/' . $fileName);

        if (!file_exists($path)) {
            abort(404, 'الملف غير موجود.');
        }

        return response()->file($path);
    }
}