<?php

namespace App\Interfaces;

interface CrudRepoInterface
{
    public function index();
    public function create();
    public function store($request);
    public function show(string $id);
    public function edit(string $id);
    public function update($request, string $id);
    public function destroy(string $id);
}
