<?php

namespace App\Repositories\Teachers\Dashboard;

use App\Interfaces\Teachers\Dashboard\TeacherLessonsInterface;
use App\Models\Grade;
use App\Models\OnlineClasse;
use App\Traits\MeetingZoomTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TeacherLessonRepository implements TeacherLessonsInterface
{
    use MeetingZoomTrait;
    // Direct
    public function index()
    {
        $online_classes = OnlineClasse::where('teacher_id', auth()->user()->id)->get();
        return view('dashboard.pages.teachers.dashboard.lessons.index', [
            'online_classes' => $online_classes
        ]);
    }

    public function create()
    {
        $grades = DB::table('teacher_grades')
            ->where('teacher_id', auth()->guard('teacher')->user()->id)
            ->pluck('grade_id');
        $grades = Grade::whereIn('id', $grades)->get();
        return view('dashboard.pages.teachers.dashboard.lessons.create', [
            'grades' => $grades
        ]);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $meeting = $this->createZoomMeeting($request);

            OnlineClasse::create([
                'meeting_topic' => $request->meeting_topic,
                'meeting_start_at' => $request->meeting_start_at,
                'meeting_duration' => $meeting['data']['duration'],
                'meeting_password' => $meeting['data']['password'],
                'join_url' => $meeting['data']['join_url'],
                'start_url' => $meeting['data']['start_url'],
                'grade_id' => $request->grade_id,
                'classe_id' => $request->classe_id,
                'section_id' => $request->section_id,
                'teacher_id' => auth()->guard('teacher')->user()->id,
                'meeting_id' => $meeting['data']['id'],
                'type' => 'direct'
            ]);

            DB::commit();
            toastr()->success(__('trans.message_added_onlineclass'));
            return redirect()->route('online_classes.index');

        } catch (\Exception $e) {
            DB::rollBack();
            toastr()->error($e->getMessage());
            return back();
        }
    }

    // Indirect
    public function createIndirect()
    {
        $grades = DB::table('teacher_grades')
            ->where('teacher_id', auth()->guard('teacher')->user()->id)
            ->pluck('grade_id');
        $grades = Grade::whereIn('id', $grades)->get();

        return view('dashboard.pages.teachers.dashboard.lessons.createIndirect', [
            'grades' => $grades
        ]);
    }

    public function storeIndirect(Request $request)
    {
        DB::beginTransaction();
        try {
            OnlineClasse::create([
                'meeting_topic' => $request->meeting_topic,
                'meeting_start_at' => $request->meeting_start_at,
                'meeting_duration' => $request->meeting_duration,
                'meeting_password' => $request->meeting_password,
                'join_url' => $request->join_url,
                'start_url' => $request->start_url,
                'grade_id' => $request->grade_id,
                'classe_id' => $request->classe_id,
                'section_id' => $request->section_id,
                'teacher_id' => auth()->guard('teacher')->user()->id,
                'meeting_id' => $request->meeting_id,
                'type' => 'indirect'
            ]);

            DB::commit();
            toastr()->success(__('trans.message_added_onlineclass'));
            return redirect()->route('online_classes.index');

        } catch (\Exception $e) {
            DB::rollBack();
            toastr()->error($e->getMessage());
            return back();
        }
    }

    public function destroy($id)
    {
        OnlineClasse::findOrFail($id)->delete();
        toastr()->success(__('trans.message_delete_onlineclass'));
        return back();
    }
}