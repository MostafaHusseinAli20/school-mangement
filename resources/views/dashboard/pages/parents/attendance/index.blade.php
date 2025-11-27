@extends('dashboard.layouts.master')

@section('title', __('trans.school_mangement_system') . ' | ' . __('trans.parent') . ' | ' .
    __('trans.attendance'))

@section('css')
    @toastr_css
@endsection

@section('content')
    <section>

        @csrf
        <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
            style="text-align: center">
            <thead>
                <tr>
                    <th class="alert-success">#</th>
                    <th class="alert-success">{{ trans('trans.name') }}</th>
                    <th class="alert-success">{{ trans('trans-parent.attendance_date') }}</th>
                    <th class="alert-success">{{ trans('trans.status') }}</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($attendances as $index => $attendance)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $attendance->students->name }}</td>
                        <td>{{ $attendance->attendance_date }}</td>
                        <td>
                            @if ($attendance->attendance_status == 1)
                                <span class="badge badge-success">{{ trans('trans.presence') }}</span>
                            @else
                                <span class="badge badge-danger">{{ trans('trans.absent') }}</span>
                            @endif
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </section><br>
@endsection

@section('js')
    @toastr_js
    @toastr_render
@endsection