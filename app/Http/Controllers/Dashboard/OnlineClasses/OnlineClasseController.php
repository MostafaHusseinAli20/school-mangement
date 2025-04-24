<?php

namespace App\Http\Controllers\Dashboard\OnlineClasses;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\OnlineClasses\OnlineClasseRequest;
use App\Interfaces\OnlineClasses\OnlineClasseInterface;
use Illuminate\Http\Request;

class OnlineClasseController extends Controller
{
    private $onlineClassInterafce;
    public function __construct(OnlineClasseInterface $onlineClassInterafce)
    {
        $this->onlineClassInterafce = $onlineClassInterafce;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->onlineClassInterafce->index();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->onlineClassInterafce->create();
    }


    public function indirectCreate()
    {
        return $this->onlineClassInterafce->indirectCreate();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OnlineClasseRequest $request)
    {
        return $this->onlineClassInterafce->store($request);
    }

    public function indirectStore(Request $request)
    {
        return $this->onlineClassInterafce->indirectStore($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        return $this->onlineClassInterafce->destroy($request);
    }
}
