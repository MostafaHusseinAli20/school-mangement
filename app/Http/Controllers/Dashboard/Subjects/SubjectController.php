<?php

namespace App\Http\Controllers\Dashboard\Subjects;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Subjects\SubjectRequest;
use App\Interfaces\Subjects\SubjectInterface;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    private $subjectInterface;
    public function __construct(SubjectInterface $subjectInterface)
    {
        $this->subjectInterface = $subjectInterface;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->subjectInterface->index();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->subjectInterface->create();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SubjectRequest $request)
    {
        return $this->subjectInterface->store($request);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return $this->subjectInterface->edit($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return $this->subjectInterface->update($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->subjectInterface->destroy($id);
    }
}