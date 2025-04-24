<?php

namespace App\Traits;

use Carbon\Carbon;
use Jubaer\Zoom\Facades\Zoom;

trait MeetingZoomTrait
{
    public function createZoomMeeting($request)
    {
        // $user = Zoom::user()->first(); // Get the first user from the Zoom account
        $meetings = Zoom::createMeeting([
            "topic" => $request->meeting_topic,
            "password" => $request->meeting_password,
            "start_time" => Carbon::parse($request->meeting_start_at)->toIso8601String(), 
            "timezone" => 'Africa/Cairo',
            "settings" => [
                'join_before_host' => false,
                'host_video' => false,
                'participant_video' => false,
                'mute_upon_entry' => true,
                'waiting_room' => true,
                'audio' => 'both',
                'auto_recording' => 'none',
            ],
        ]);
        return $meetings;
    }
}
