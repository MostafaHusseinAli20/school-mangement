@extends('dashboard.layouts.master')
@section('title', __('trans.school_mangement_system') . ' | ' . __('trans.sections_list'))
    
@section('css')
    @toastr_css
@endsection

@section('content')
   <!-- row -->
   <div class="row">

    <div class="col-xl-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">

                <div class="table-responsive">
                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                           style="text-align: center">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ trans('trans.grade') }}</th>
                            <th>{{ trans('trans.section') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($sections as $index => $section)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $section->grades->name }}</td>
                                <td>{{ $section->name_section }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@section('js')
    @toastr_js
    @toastr_render
@endsection