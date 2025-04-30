@extends('dashboard.layouts.master')

@section('title', __('trans.school_mangement_system') . ' | ' . __('trans.teacher') . ' | ' . __('trans.main'))

@section('content')
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6 mb-2">
                <h4 class="mb-0" style="font-family: 'Cairo', sans-serif"> {{ trans('trans-teacher.welcome') }}: {{ auth()->guard('teacher')->user()->name }}</h4>
                </h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
                </ol>
            </div>
        </div>
    </div>

    <!-- widgets -->
    <div class="row">
        <div class="col-xl-6 col-lg-6 col-md-6 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">

                    <div class="clearfix">
                        <div class="float-left">
                            <span class="text-success">
                                <i class="fas fa-user-graduate highlight-icon" aria-hidden="true"></i>
                            </span>
                        </div>
                        <div class="float-right text-right">
                            <p class="card-text text-dark" style="font-family: 'Cairo', sans-serif">
                                {{ trans('trans.student_counts') }}</p>
                            <h4>{{ $students_count }}</h4>
                        </div>
                    </div>

                    <p class="text-muted pt-3 mb-0 mt-2 border-top">
                        <i class="fas fa-binoculars mr-1" aria-hidden="true"></i><a href="{{ route('teacher.students') }}"
                            target="_blank"><span class="text-danger">
                                {{ trans('trans.show_data') }}
                            </span></a>
                    </p>
                </div>
            </div>

        </div>
        <div class="col-xl-6 col-lg-6 col-md-6 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="clearfix">
                        <div class="float-left">
                            <span class="text-warning">
                                <i class="fas fa-chalkboard-teacher highlight-icon" aria-hidden="true"></i>
                            </span>
                        </div>
                        <div class="float-right text-right">
                            <p class="card-text text-dark" style="font-family: 'Cairo', sans-serif">
                                {{ trans('trans-teacher.sections_counts') }}</p>
                            <h4>{{ $sections_count }}</h4>
                        </div>
                    </div>
                    <p class="text-muted pt-3 mb-0 mt-2 border-top">
                        <i class="fas fa-binoculars mr-1" aria-hidden="true"></i><a href="{{ route('teacher.sections') }}"
                            target="_blank"><span class="text-danger">
                                {{ trans('trans.show_data') }}
                            </span>
                        </a>
                    </p>
                </div>
            </div>
        </div>

    </div>
    <!-- end widgets -->

    <!-- Orders Status widgets-->

    <div class="row">

        <div style="height: 400px;" class="col-xl-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="tab nav-border" style="position: relative;">
                        <div class="d-block d-md-flex justify-content-between">
                            <div class="d-block w-100">
                                <h5 style="font-family: 'Cairo', sans-serif" class="card-title">
                                    {{ trans('trans.latest_operations') }}</h5>
                            </div>
                            <div class="d-block d-md-flex nav-tabs-custom">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">

                                    <li class="nav-item">
                                        <a class="nav-link active show" id="students-tab" data-toggle="tab" href="#students"
                                            role="tab" aria-controls="students"
                                            aria-selected="true">{{ trans('trans.students') }}</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" id="teachers-tab" data-toggle="tab" href="#teachers"
                                            role="tab" aria-controls="teachers"
                                            aria-selected="false">{{ trans('trans.teachers') }}
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" id="parents-tab" data-toggle="tab" href="#parents"
                                            role="tab" aria-controls="parents"
                                            aria-selected="false">{{ trans('trans.parents') }}
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" id="fee_invoices-tab" data-toggle="tab" href="#fee_invoices"
                                            role="tab" aria-controls="fee_invoices"
                                            aria-selected="false">{{ trans('trans.invoices') }}
                                        </a>
                                    </li>

                                </ul>
                            </div>
                        </div>
                        <div class="tab-content" id="myTabContent">

                            {{-- students Table --}}
                            <div class="tab-pane fade active show" id="students" role="tabpanel"
                                aria-labelledby="students-tab">
                                <div class="table-responsive mt-15">
                                    <table style="text-align: center" class="table center-aligned-table table-hover mb-0">
                                        <thead>
                                            <tr class="table-info text-danger">
                                                <th>#</th>
                                                <th>{{ trans('trans.student_name') }}</th>
                                                <th>{{ trans('trans.Email') }}</th>
                                                <th>{{ trans('trans.gender') }}</th>
                                                <th>{{ trans('trans.grade') }}</th>
                                                <th>{{ trans('trans.acadmy_classe') }}</th>
                                                <th>{{ trans('trans.section') }}</th>
                                                <th>{{ trans('trans.created_at') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse(\App\Models\Student::latest()->take(5)->get() as $student)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $student->name }}</td>
                                                    <td>{{ $student->email }}</td>
                                                    <td>{{ $student->genders->name }}</td>
                                                    <td>{{ $student->grades->name }}</td>
                                                    <td>{{ $student->classes->classe_name }}</td>
                                                    <td>{{ $student->sections->name_section }}</td>
                                                    <td class="text-success">{{ $student->created_at }}</td>
                                                @empty
                                                    <td class="alert-danger" colspan="8">لاتوجد بيانات</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            {{-- teachers Table --}}
                            <div class="tab-pane fade" id="teachers" role="tabpanel" aria-labelledby="teachers-tab">
                                <div class="table-responsive mt-15">
                                    <table style="text-align: center" class="table center-aligned-table table-hover mb-0">
                                        <thead>
                                            <tr class="table-info text-danger">
                                                <th>#</th>
                                                <th>{{ trans('trans.name_teacher') }}</th>
                                                <th>{{ trans('trans.gender') }}</th>
                                                <th>{{ trans('trans.joining_date') }}</th>
                                                <th>{{ trans('trans.specialization') }}</th>
                                                <th>{{ trans('trans.created_at') }}</th>
                                            </tr>
                                        </thead>

                                        @forelse(\App\Models\Teacher::latest()->take(5)->get() as $teacher)
                                            <tbody>
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $teacher->name }}</td>
                                                    <td>{{ $teacher->genders->name }}</td>
                                                    <td>{{ $teacher->joining_data }}</td>
                                                    <td>{{ $teacher->specialisations->name }}</td>
                                                    <td class="text-success">{{ $teacher->created_at }}</td>
                                                @empty
                                                    <td class="alert-danger" colspan="8">لاتوجد بيانات</td>
                                                </tr>
                                            </tbody>
                                        @endforelse
                                    </table>
                                </div>
                            </div>

                            {{-- parents Table --}}
                            <div class="tab-pane fade" id="parents" role="tabpanel" aria-labelledby="parents-tab">
                                <div class="table-responsive mt-15">
                                    <table style="text-align: center" class="table center-aligned-table table-hover mb-0">
                                        <thead>
                                            <tr class="table-info text-danger">
                                                <th>#</th>
                                                <th>{{ trans('trans.name_parent') }}</th>
                                                <th>{{ trans('trans.Email') }}</th>
                                                <th>{{ trans('trans.National_id') }}</th>
                                                <th>{{ trans('trans.phone_number') }}</th>
                                                <th>{{ trans('trans.created_at') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse(\App\Models\MyParent::latest()->take(5)->get() as $parent)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $parent->name_father }}</td>
                                                    <td>{{ $parent->email }}</td>
                                                    <td>{{ $parent->national_ID_father }}</td>
                                                    <td>{{ $parent->phone_father }}</td>
                                                    <td class="text-success">{{ $parent->created_at }}</td>
                                                @empty
                                                    <td class="alert-danger" colspan="8">لاتوجد بيانات</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            {{-- sections Table --}}
                            <div class="tab-pane fade" id="fee_invoices" role="tabpanel"
                                aria-labelledby="fee_invoices-tab">
                                <div class="table-responsive mt-15">
                                    <table style="text-align: center" class="table center-aligned-table table-hover mb-0">
                                        <thead>
                                            <tr class="table-info text-danger">
                                                <th>#</th>
                                                <th>{{ trans('trans.invoice_number') }}</th>
                                                <th>{{ trans('trans.student_name') }}</th>
                                                <th>{{ trans('trans.grade') }}</th>
                                                <th>{{ trans('trans.acadmy_classe') }}</th>
                                                <th>{{ trans('trans.section') }}</th>
                                                <th>{{ trans('trans.fee_type') }}</th>
                                                <th>{{ trans('trans.amount') }}</th>
                                                <th>{{ trans('trans.created_at') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse(\App\Models\FeeInvocie::latest()->take(10)->get() as $section)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $section->invoice_date }}</td>
                                                    <td>{{ $section->classes->classe_name }}</td>
                                                    <td class="text-success">{{ $section->created_at }}</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td class="alert-danger" colspan="9">لاتوجد بيانات</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end Orders Status widgets-->
@endsection
