<?php

namespace App\Livewire;

use App\Models\Event;
use Livewire\Component;

class Calender extends Component
{
    public string $events = '';
    public bool $showModal = false;
    public string $newEventTitle = '';
    public string $newEventStart = '';

    public function openModal($date)
    {
        $this->newEventStart = $date;
        $this->showModal = true;
    }

    public function saveEvent()
    {
        $this->validate([
            'newEventTitle' => 'required|string|max:255',
            'newEventStart' => 'required|date',
        ]);

        Event::create([
            'title' => $this->newEventTitle,
            'start' => $this->newEventStart,
        ]);

        $this->reset(['newEventTitle', 'newEventStart', 'showModal']);
        $this->loadEvents();
    }

    public function mount()
    {
        $this->loadEvents();
    }

    public function loadEvents()
    {
        $this->events = json_encode(Event::select('id', 'title', 'start')->get());
    }

    public function addevent(array $event): void
    {
        Event::create([
            'title' => $event['title'],
            'start' => $event['start'],
        ]);

        $this->loadEvents(); // لتحديث الأحداث بعد الإضافة
    }

    public function eventDrop(array $event): void
    {
        $eventdata = Event::find($event['id']);
        if ($eventdata) {
            $eventdata->start = $event['start'];
            $eventdata->save();
        }

        $this->loadEvents(); // لتحديث الأحداث بعد النقل
    }

    public function render()
    {
        return view('livewire.calender');
    }
}