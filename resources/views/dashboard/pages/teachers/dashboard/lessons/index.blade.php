@extends('dashboard.layouts.master')

@section('title', __('trans.school_mangement_system') . ' | ' . __('trans.onlineclasses_list'))

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
                                <a href="{{route('teacher.online_classes.create')}}" class="btn btn-success" role="button" aria-pressed="true">{{ trans('trans.add_onlineclass') }}</a>
                                <a class="btn btn-warning" href="{{route('teacher.online.indirect_create')}}">{{ trans('trans.add_indirect_onlineclass') }}</a>
                                <div class="table-responsive">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                        data-page-length="50" style="text-align: center">
                                        <thead>
                                            <tr class="alert-success">
                                                <th>#</th>
                                                <th>{{ trans('trans.stage') }}</th>
                                                <th>{{ trans('trans.class') }}</th>
                                                <th>{{ trans('trans.section') }}</th>
                                                <th>{{ trans('trans.teacher') }}</th>
                                                <th>{{ trans('trans.lesson_address') }}</th>
                                                <th>{{ trans('trans.onlineclass_date') }}</th>
                                                <th>{{ trans('trans.onlineclass_time') }}</th>
                                                <th>{{ trans('trans.onlineclass_link') }}</th>
                                                <th>{{ trans('trans.onlineclass_type') }}</th>
                                                <th>{{ trans('trans.processes') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($online_classes as $index => $online_classe)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $online_classe->grade->name }}</td>
                                                    <td>{{ $online_classe->classe->classe_name }}</td>
                                                    <td>{{ $online_classe->section->name_section }}</td>
                                                    <td>{{ $online_classe->teacher->name ?? '' }}</td>
                                                    <td>{{ $online_classe->meeting_topic }}</td>
                                                    <td>{{ $online_classe->meeting_start_at }}</td>
                                                    <td>{{ $online_classe->meeting_duration }}</td>
                                                    <td>
                                                        @if ($online_classe->type == 'indirect')
                                                            <span class="badge badge-danger">
                                                                {{ trans('trans.indirect') }}
                                                            </span>
                                                        @else
                                                            <span class="badge badge-success">
                                                                {{ trans('trans.direct') }}
                                                            </span>
                                                        @endif
                                                    </td>
                                                    <td class="text-danger"><a href="{{ $online_classe->join_url }}"
                                                            target="_blank"> {{ trans('trans.join_now') }} </a></td>
                                                    {{-- <td>{{ $online_classe->type }}</td> --}}
                                                    <td>
                                                        <button type="button" class="btn btn-danger btn-sm"
                                                            data-toggle="modal"
                                                            data-target="#Delete_receipt{{ $online_classe->meeting_id }}"><i
                                                                class="fa fa-trash"></i></button>
                                                    </td>
                                                </tr>
                                                @include('dashboard.pages.online_classes.delete')
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
