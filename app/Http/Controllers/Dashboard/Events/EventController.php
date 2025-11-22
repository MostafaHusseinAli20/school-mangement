<?php

namespace App\Http\Controllers\Dashboard\Events;

use App\Http\Controllers\Controller;
use App\Interfaces\Events\EventInterface;
use Illuminate\Http\Request;

class EventController extends Controller
{
    private $eventInterface;
    
    public function __construct(EventInterface $eventInterface)
    {
        $this->eventInterface = $eventInterface;
    }

    public function index()
    {
        return $this->eventInterface->index();
    }

    public function store(Request $request)
    {
        return $this->eventInterface->store($request);
    }

    public function update(Request $request)
    {
        return $this->eventInterface->update($request);
    }
}
