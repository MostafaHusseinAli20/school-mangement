<?php

namespace App\Http\Controllers\Dashboard\Sections;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Sections\SectionRequest;
use App\Repositories\Sections\SectionRepository;

class SectionsController extends Controller
{
    private $sectionRepository;
    public function __construct(SectionRepository $sectionRepository)
    {
        $this->sectionRepository = $sectionRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       return $this->sectionRepository->index();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SectionRequest $request)
    {
       return $this->sectionRepository->store($request);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SectionRequest $request, string $id)
    {
        return $this->sectionRepository->update($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->sectionRepository->destroy($id);
    }

    public function getclasses($id)
    {
        return $this->sectionRepository->getclasses($id);
    }
}
