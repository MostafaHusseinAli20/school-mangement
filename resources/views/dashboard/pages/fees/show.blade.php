@extends('dashboard.layouts.master')
@section('title', __('trans.school_mangement_system') . ' | ' . __('trans.study_fees'))
    
@section('css')
    @toaster_css
@endsection

@section('content')
     <!-- row -->
     <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="col-xl-12 mb-30">
                        <div class="card card-statistics h-100">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                           data-page-length="50"
                                           style="text-align: center">
                                        <thead>
                                        <tr class="alert-success">
                                            <th>#</th>
                                            <th>{{ trans('trans.name') }}</th>
                                            <th>{{ trans('trans.amount') }}</th>
                                            <th>{{ trans('trans.grade') }}</th>
                                            <th>{{ trans('trans.acadmy_classe') }}</th>
                                            <th>{{ trans('trans.study_year') }}</th>
                                            <th>{{ trans('trans.processes') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($students as $index => $student)
                                            <tr>
                                            <td>{{ $index + 1  }}</td>
                                            <td>{{$student->name}}</td>
                                            <td>{{ number_format($fee->amount, 2) }}</td>
                                            <td>{{$student->grades->name}}</td>
                                            <td>{{$fee->classes->classe_name}}</td>
                                            <td>{{$fee->year}}</td>

                                                <td>
                                                   
                                                </td>
                                            </tr>
                                       
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection

@section('js')
    @toastr_js
    @toastr_render
@endsection 