@extends('dashboard.layouts.master')
@section('title', __('trans.school_mangement_system') . " | " . __('trans.teachers_list'))

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
                                <a href="{{ route('teachers.create') }}" class="btn btn-success btn-sm" role="button"
                                    aria-pressed="true">{{ trans('trans.add_teacher') }}</a><br><br>
                                <div class="table-responsive">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                        data-page-length="50" style="text-align: center">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>{{ trans('trans.name_teacher') }}</th>
                                                <th>{{ trans('trans.gender') }}</th>
                                                <th>{{ trans('trans.joining_date') }}</th>
                                                <th>{{ trans('trans.specialization') }}</th>
                                                <th>{{ trans('trans.processes') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 0; ?>
                                            @foreach ($teachers as $teacher)
                                                <tr>
                                                    <?php $i++; ?>
                                                    <td>{{ $i }}</td>
                                                    <td>{{ $teacher->name }}</td>
                                                    <td>{{ $teacher->genders->name }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($teacher->joining_data)->format('d-m-Y') }}</td>
                                                    <td>{{ $teacher->specialisations->name }}</td>
                                                    <td>
                                                        <a href="{{ route('teachers.edit', $teacher->id) }}"
                                                            class="btn btn-info btn-sm" role="button"
                                                            aria-pressed="true"><i class="fa fa-edit"></i></a>
                                                        <button type="button" class="btn btn-danger btn-sm"
                                                            data-toggle="modal"
                                                            data-target="#delete_Teacher{{ $teacher->id }}"
                                                            title="{{ trans('trans.Delete') }}"><i
                                                                class="fa fa-trash"></i></button>
                                                    </td>
                                                </tr>

                                                <div class="modal fade" id="delete_Teacher{{ $teacher->id }}"
                                                    tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <form action="{{ route('teachers.destroy', $teacher->id) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('delete')
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 style="font-family: 'Cairo', sans-serif;"
                                                                        class="modal-title" id="exampleModalLabel">
                                                                        {{ trans('trans.delete_teacher') }}</h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p> {{ trans('trans.warning_grade') }}</p>
                                                                    <input type="hidden" name="id"
                                                                        value="{{ $teacher->id }}">
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal">{{ trans('trans.close') }}</button>
                                                                        <button type="submit"
                                                                            class="btn btn-danger">{{ trans('trans.submit') }}</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
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
