<?php

namespace App\Http\Controllers\Dashboard\Parent\Dashboard;

use App\Http\Controllers\Controller;
use App\Interfaces\Parents\ParentMainInterface;
use Illuminate\Http\Request;

class ParentMainController extends Controller
{
    private $parentMainInterface;
    public function __construct(ParentMainInterface $parentMainInterface)
    {
        $this->parentMainInterface = $parentMainInterface;
    }

    public function index()
    {
        return $this->parentMainInterface->index();
    }

    public function grades()
    {
        return $this->parentMainInterface->grades();
    }

    public function children()
    {
        return $this->parentMainInterface->children();
    }

    public function filterChildern(Request $request)
    {
        return $this->parentMainInterface->filterChildern($request);
    }

    public function fees()
    {
        return $this->parentMainInterface->fees();
    }

    public function feesRecipt($id)
    {
        return $this->parentMainInterface->feesRecipt($id);
    }

    public function profile()
    {
        return $this->parentMainInterface->profile();
    }

    public function updateProfile(Request $request, $id)
    {
        return $this->parentMainInterface->updateProfile($request, $id);
    }
}
