<?php

namespace App\Http\Controllers\Dashboard\Sections;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Sections\SectionRequest;
use App\Interfaces\Sections\SectionInterface;

class SectionsController extends Controller
{
    private $sectionInterface;
    public function __construct(SectionInterface $sectionInterface)
    {
        $this->sectionInterface = $sectionInterface;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       return $this->sectionInterface->index();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SectionRequest $request)
    {
       return $this->sectionInterface->store($request);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SectionRequest $request, string $id)
    {
        return $this->sectionInterface->update($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->sectionInterface->destroy($id);
    }

    public function getclasses($id)
    {
        return $this->sectionInterface->getclasses($id);
    }
}
