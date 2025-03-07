<?php

namespace App\Http\Controllers\Dashboard\Grade;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Grades\GradeRequest;
use App\Interfaces\Grades\GradeInterface;
use App\Repositories\Grades\GradeRepository;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    private $gradeInterface;
    public function __construct(GradeInterface $gradeInterface)
    {
        $this->gradeInterface = $gradeInterface;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       return $this->gradeInterface->index();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GradeRequest $request)
    {
        return $this->gradeInterface->store($request);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GradeRequest $request, string $id)
    {
        return $this->gradeInterface->update($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        return $this->gradeInterface->destroy($request);
    }
}
