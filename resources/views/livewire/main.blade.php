@extends('dashboard.layouts.master')
@section('title', __('trans.school_mangement_system') . " | " . __('trans.parents_list'))
@section('content')
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <livewire:add-parent />
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- @section('js')
    @livewireScripts
@endsection --}}
