<?php

namespace App\Interfaces\Library;

interface LibraryInterface
{
    public function index();
    public function create();
    public function store($request);
    public function show($id);
    public function edit($id);
    public function update($request, $id);
    public function destroy($id);
    public function download($filename);
    public function open_file($filename);
}
