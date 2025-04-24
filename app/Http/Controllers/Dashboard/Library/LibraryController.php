<?php

namespace App\Http\Controllers\Dashboard\Library;

use App\Http\Controllers\Controller;
use App\Interfaces\Library\LibraryInterface;
use Illuminate\Http\Request;

class LibraryController extends Controller
{
    private $libraryInterface;

    public function __construct(LibraryInterface $libraryInterface)
    {
        $this->libraryInterface = $libraryInterface;
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->libraryInterface->index();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->libraryInterface->create();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $this->libraryInterface->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->libraryInterface->show($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return $this->libraryInterface->edit($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return $this->libraryInterface->update($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->libraryInterface->destroy($id);
    }

    public function download($filename)
    {
        return $this->libraryInterface->download($filename);
    }

    public function open_file($filename)
    {
        return $this->libraryInterface->open_file($filename);
    }
}
