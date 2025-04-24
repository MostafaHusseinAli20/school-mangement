<?php

namespace App\Interfaces\Fees;

interface FeeInterface
{
    public function index();
    public function create();
    public function store($request);
    public function show($id);
    public function edit($id);
    public function update($request, $id);
    public function destroy($id);
}
