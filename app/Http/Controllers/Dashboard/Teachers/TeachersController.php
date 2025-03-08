<?php

namespace App\Http\Controllers\Dashboard\Teachers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Teachers\TeacherRequest;
use App\Http\Requests\Dashboard\Teachers\UpdateTeacherRequest;
use App\Interfaces\Teachers\TeacherInterface;
use Illuminate\Http\Request;

class TeachersController extends Controller
{
    private $teacherInterface;
    public function __construct(TeacherInterface $teacherInterface)
    {
        $this->teacherInterface = $teacherInterface;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->teacherInterface->index();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->teacherInterface->create();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TeacherRequest $request)
    {
        return $this->teacherInterface->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->teacherInterface->show($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return $this->teacherInterface->edit($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        return $this->teacherInterface->update($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->teacherInterface->destroy($id);
    }
}
