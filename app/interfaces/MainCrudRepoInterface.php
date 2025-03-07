<?php

namespace App\Interfaces;

interface MainCrudRepoInterface
{
    public function index();
    public function store($request);
    public function update($request, $id);
    public function destroy($id);
    public function getclasses($id);
}
