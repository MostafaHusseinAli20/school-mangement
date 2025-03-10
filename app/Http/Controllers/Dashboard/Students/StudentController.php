<?php

namespace App\Http\Controllers\Dashboard\Students;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Students\StudentRequest;
use App\Http\Requests\Dashboard\Students\UpdateStudentRequest;
use App\Interfaces\Students\StudentInterface;

class StudentController extends Controller
{
    public $studentInteface;

    public function __construct(StudentInterface $studentInteface)
    {
        $this->studentInteface = $studentInteface;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->studentInteface->index();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->studentInteface->create();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StudentRequest $request)
    {
        return $this->studentInteface->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return $this->studentInteface->edit($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStudentRequest $request, $id)
    {
        return $this->studentInteface->update($request,$id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        return $this->studentInteface->destroy($id);
    }

    public function getClasses($id)
    {
       return $this->studentInteface->getClasses($id);
    }

    public function getSections($id)
    {
        return $this->studentInteface->getSections($id);
    }
}
