<?php

namespace App\Http\Controllers\Dashboard\Classes;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Classes\ClasseRequest;
use App\Repositories\Classes\ClasseRepository;
use Illuminate\Http\Request;

class ClassesController extends Controller
{
    private $classeRepo;
    public function __construct(ClasseRepository $classeRepo)
    {
        $this->classeRepo = $classeRepo;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->classeRepo->index();
    }

    public function show(string $id)
    {
        return $this->classeRepo->show($id);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(ClasseRequest $request)
    {
        return $this->classeRepo->store($request);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ClasseRequest $request)
    {
        return $this->classeRepo->update($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->classeRepo->destroy($id);
    }

    public function delete_all(Request $request)
    {
        return $this->classeRepo->delete_all($request);
    }

    public function filter_classe(Request $request)
    {
        return $this->classeRepo->filter_classe($request);
    }
}
