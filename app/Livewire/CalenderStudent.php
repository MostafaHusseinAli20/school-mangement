<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Event;

class CalenderStudent extends Component
{
    public $events = '';
    public function getevent()
    {
        $events = Event::select('id','title','start')->get();
        return  json_encode($events);
    }

    public function render()
    {
        $events = Event::select('id','title','start')->get();
        $this->events = json_encode($events);
        return view('livewire.calender-student');
    }
}
