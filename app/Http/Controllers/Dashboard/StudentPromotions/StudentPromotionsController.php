<?php

namespace App\Http\Controllers\Dashboard\StudentPromotions;

use App\Http\Controllers\Controller;
use App\Interfaces\Students\StudentPromotionsInterface;
use Illuminate\Http\Request;

class StudentPromotionsController extends Controller
{
    public $studentPromotionInterface;
    public function __construct(StudentPromotionsInterface $studentPromotionInterface)
    {
        $this->studentPromotionInterface = $studentPromotionInterface;
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->studentPromotionInterface->index();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->studentPromotionInterface->create();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $this->studentPromotionInterface->store($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        return $this->studentPromotionInterface->destroy($request);
    }
}
