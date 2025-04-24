@extends('dashboard.layouts.master')

@section('title', __('trans.school_mangement_system') . ' | ' . __('trans.mangement_promotion'))

@section('css')
    @toastr_css
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

                                {{-- @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif --}}

                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#Delete_all">
                                    {{ trans('trans.rollback_all') }}
                                </button>
                                <br><br>

                                <div class="table-responsive">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                        data-page-length="50" style="text-align: center">
                                        <thead>
                                            <tr>
                                                <th class="alert-info">#</th>
                                                <th class="alert-info">{{ trans('trans.name') }}</th>
                                                <th class="alert-danger">{{ trans('trans.grade_stage_old') }}</th>
                                                <th class="alert-danger">{{ trans('trans.old_academic_year') }}</th>
                                                <th class="alert-danger">{{ trans('trans.old_classe') }}</th>
                                                {{-- <th class="alert-danger">القسم الدراسي السابق</th> --}}
                                                <th class="alert-success">{{ trans('trans.grade_stage_new') }}</th>
                                                <th class="alert-success">{{ trans('trans.new_academic_year') }}</th>
                                                <th class="alert-success">{{ trans('trans.new_classe') }}</th>
                                                {{-- <th class="alert-success">القسم الدراسي الحالي</th> --}}
                                                <th class="alert-secondary">{{ trans('trans.processes') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($promotions as $promotion)
                                                <tr>
                                                    <td>#</td>
                                                    <td>{{ $promotion->students->name }}</td>
                                                    <td>{{ $promotion->f_grade->name }}</td>
                                                    <td>{{ $promotion->academic_year_old }}</td>
                                                    <td>{{ $promotion->f_classe->classe_name }}</td>
                                                    {{-- <td>{{ $promotion->f_section->name_section }}</td> --}}
                                                    <td>{{ $promotion->t_grade->name }}</td>
                                                    <td>{{ $promotion->academic_year_new }}</td>
                                                    <td>{{ $promotion->t_classe->classe_name }}</td>
                                                    {{-- <td>{{ $promotion->t_section->name_section }}</td> --}}
                                                    <td style="display: flex; justify-content: center; gap: 3px;">
                                                        <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#Delete_one{{$promotion->id}}">{{ trans('trans.rollback_student') }}</button>
                                                        <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#">{{ trans('trans.graduate_student') }}</button>
                                                    </td>
                                                </tr>
                                                @include('dashboard.pages.students.promotions.delete_one')
                                                @include('dashboard.pages.students.promotions.delete_all')
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
