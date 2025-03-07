<?php

namespace App\Interfaces\Classes;

interface ClassesInterface
{
    public function index();
    public function show($id);
    public function store($request);
    public function update($request);
    public function destroy($id);
    public function delete_all($request);
    public function filter_classe($request);
    
}
