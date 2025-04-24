<?php

namespace App\Http\Controllers\Dashboard\Classes;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Classes\ClasseRequest;
use App\Interfaces\Classes\ClassesInterface;
use Illuminate\Http\Request;

class ClassesController extends Controller
{
    private $classInterface;
    public function __construct(ClassesInterface $classInterface)
    {
        $this->classInterface = $classInterface;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->classInterface->index();
    }

    public function show(string $id)
    {
        return $this->classInterface->show($id);
    }

    /**
     * Store a newly created resource in storage.
     */
    
    public function store(ClasseRequest $request)
    {
        return $this->classInterface->store($request);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ClasseRequest $request)
    {
        return $this->classInterface->update($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->classInterface->destroy($id);
    }

    public function delete_all(Request $request)
    {
        return $this->classInterface->delete_all($request);
    }

    public function filter_classe(Request $request)
    {
        return $this->classInterface->filter_classe($request);
    }
}
