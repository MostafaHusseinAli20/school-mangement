<?php

namespace App\Http\Controllers\Dashboard\Grade;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Grades\GradeRequest;
use App\Repositories\Grades\GradeRepository;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    private $gradeRepo;
    public function __construct(GradeRepository $gradeRepo)
    {
        $this->gradeRepo = $gradeRepo;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       return $this->gradeRepo->index();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GradeRequest $request)
    {
        return $this->gradeRepo->store($request);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GradeRequest $request, string $id)
    {
        return $this->gradeRepo->update($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        return $this->gradeRepo->destroy($request);
    }
}
