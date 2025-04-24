<?php

namespace App\Repositories\OnlineClasses;

use App\Interfaces\OnlineClasses\OnlineClasseInterface;
use App\Models\Grade;
use App\Models\OnlineClasse;
use App\Traits\MeetingZoomTrait;
use Illuminate\Support\Facades\DB;
use Jubaer\Zoom\Facades\Zoom;

class OnlineClasseRepository implements OnlineClasseInterface
{
    use MeetingZoomTrait;

    public function index()
    {
        $online_classes = OnlineClasse::get();
        return view('dashboard.pages.online_classes.index', compact('online_classes'));
    }

    public function create()
    {
        $grades = Grade::get();
        return view('dashboard.pages.online_classes.add', compact('grades'));
    }

    // Create Indirect
    public function indirectCreate()
    {
        $grades = Grade::get();
        return view('dashboard.pages.online_classes.indirect', compact('grades'));
    }

    public function store($request)
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
                'user_id' => auth()->user()->id,
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

    // Store Indirect
    public function indirectStore($request)
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
                'user_id' => auth()->user()->id,
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

    public function destroy($request)
    {
        DB::beginTransaction();
        try {
            $meetingId = $request->id;
            $meeting = Zoom::getMeeting($meetingId);

            if ($meeting) {
                $deleteMeeting = Zoom::deleteMeeting($meetingId); 
                
                if($deleteMeeting)
                {
                    OnlineClasse::where('meeting_id', $meetingId)->delete();
                }else{
                    toastr()->error('failed to delete meeting');
                    return back();
                }
            }

            DB::commit();
            toastr()->success(__('trans.message_deleted_onlineclass'));
            return back();
        } catch (\Exception $e) {
            // Rollback the transaction on error
            DB::rollBack();
            toastr()->error($e->getMessage());
            return back();
        }
    }
}