<?php

namespace App\Interfaces;

interface CustomCrudRepoInterface
{
    public function index();
    public function store($request);
    public function show($id);
    public function update($request);
    public function destroy($id);
    public function delete_all($request);
    public function filter_classe($request);
}
