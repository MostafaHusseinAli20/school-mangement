@extends('dashboard.layouts.master')

@section('title', __('trans.school_mangement_system') . ' | ' . __('trans.grade_list'))

@section('css')
    @toaster_css
@endsection

@section('content')
    <div class="row">


        @if ($errors->any())
            <div class="error">{{ $errors->first('name') }}</div>
        @endif


        <div class="col-xl-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <button type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal">
                        {{ trans('trans.add_grade') }}
                    </button>
                    <br><br>
                    <div class="table-responsive">
                        <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                            style="text-align: center">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ trans('trans.name') }}</th>
                                    <th>{{ trans('trans.notes') }}</th>
                                    <th>{{ trans('trans.processes') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 0;
                                @endphp
                                @foreach ($grades as $grade)
                                    @php
                                        $i++;
                                    @endphp
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $grade->name }}</td>
                                        <td>{{ $grade->notes }}</td>
                                        <td>
                                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                                data-target="#edit{{ $grade->id }}" title="{{ trans('trans.edit') }}"><i
                                                    class="fa fa-edit"></i></button>
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                data-target="#delete{{ $grade->id }}"
                                                title="{{ trans('trans.delete') }}"><i class="fa fa-trash"></i></button>
                                        </td>
                                    </tr>

                                    @include('dashboard.pages.grades.models.edit_model')

                                    @include('dashboard.pages.grades.models.delete_model')
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        @include('dashboard.pages.grades.models.add_model')

    </div>
@endsection

@section('js')
    @toastr_js
    @toastr_render
@endsection
