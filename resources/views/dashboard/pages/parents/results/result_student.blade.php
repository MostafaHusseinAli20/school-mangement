@extends('dashboard.layouts.master')

@section('title', __('trans.school_mangement_system') . ' | ' . __('trans-parent.parents') . ' | ' .
    __('trans-parent.results'))

@section('css')
    @toastr_css
@endsection

@section('content')
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
                                    <th>{{ trans('trans.name') }}</th>
                                    <th>{{ trans('trans.quizze_name') }}</th>
                                    <th>{{ trans('trans-student.student_score') }}</th>
                                    <th>{{ trans('trans.status') }}</th>
                                    <th scope="row">{{ trans('trans-student.percentage') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 0;
                                @endphp
                                @foreach ($results as $result)
                                    @php
                                        $i++;
                                    @endphp
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $result->student->name }}</td>
                                        <td>{{ \App\Models\Quizze::find($result->quiz_id)->name ?? '-' }}</td>
                                        <td>{{ round($result->student_score, 0) }}</td>
                                        <td>
                                            @if ($result->status == 'passed')
                                                <span class="badge badge-success">{{ trans('trans-student.passed') }}</span>
                                            @else
                                                <span class="badge badge-danger">{{ trans('trans-student.failed') }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if (!is_null($result->percentage))
                                                @if ($result->percentage >= 90)
                                                    <span
                                                        class="badge badge-success">{{ round($result->percentage) }}%</span>
                                                @elseif($result->percentage < 50)
                                                    <span
                                                        class="badge badge-danger">{{ round($result->percentage) }}%</span>
                                                @else
                                                    <span
                                                        class="badge badge-warning">{{ round($result->percentage) }}%</span>
                                                @endif
                                            @else
                                                <span class="badge badge-info">
                                                    {{ trans('trans-parent.no_degree_exist') }}
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
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
