@extends('dashboard.layouts.master')

@section('title', __('trans.school_mangement_system') . ' | ' . __('trans.parent') . ' | ' .
    __('trans-parent.children_list'))

@section('css')
    @toastr_css
@endsection

@section('content')
    <div class="row">

        <div class="col-xl-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">

                    <div class="col-md-3 mb-3">
                        <label for="" class="mr-sm-2 form-label">{{ trans('trans.gender') }}</label>
                        <select id="filter_gender" name="gender" class="form-control p-0 mb-3">
                            <option value="" disabled selected>{{ trans('trans.Choose') }}</option>
                            <option value="1">{{ trans('trans-parent.male') }}</option>
                            <option value="2">{{ trans('trans-parent.female') }}</option>
                        </select>

                        <label for="" class="mr-sm-2 form-label">{{ trans('trans.grade') }}</label>
                        <select id="filter_grade" name="grade" class="form-control p-0">
                            <option value="" disabled selected>{{ trans('trans.Choose') }}</option>
                            @foreach ($grades as $grade)
                                <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                            @endforeach
                        </select>
                    </div>


                    <div class="table-responsive">
                        <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                            style="text-align: center">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ trans('trans.name') }}</th>
                                    <th>{{ trans('trans.Email') }}</th>
                                    <th>{{ trans('trans-parent.academic_year') }}</th>
                                    <th>{{ trans('trans-parent.date_birth') }}</th>
                                    <th>{{ trans('trans-parent.type_blood') }}</th>
                                    <th>{{ trans('trans.gender') }}</th>
                                    <th>{{ trans('trans.grade') }}</th>
                                    <th>{{ trans('trans.class') }}</th>
                                    <th>{{ trans('trans.section') }}</th>
                                    <th>{{ trans('trans.processes') }}</th>
                                </tr>
                            </thead>
                            <tbody id="filteration">
                                @php
                                    $i = 0;
                                @endphp
                                @foreach ($sons as $son)
                                    @php
                                        $i++;
                                    @endphp
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $son->name }}</td>
                                        <td>{{ $son->email ?? '-' }}</td>
                                        <td>{{ $son->academic_year ?? '-' }}</td>
                                        <td>{{ $son->date_birth ?? '-' }}</td>
                                        <td>{{ $son->type_blood ?? '-' }}</td>
                                        <td>{{ $son->genders->name ?? '-' }}</td>
                                        <td>{{ $son->grades->name ?? '-' }}</td>
                                        <td>{{ $son->classes->classe_name ?? '-' }}</td>
                                        <td>{{ $son->sections->name_section ?? '-' }}</td>
                                        <td>
                                            <div class="dropdown show">
                                                <a class="btn btn-success btn-sm dropdown-toggle" href="#"
                                                    role="button" id="dropdownMenuLink" data-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false">
                                                    {{ trans('trans.processes') }}
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">

                                                    <a class="dropdown-item"
                                                        href="{{ route('parent.children.result', $son->id) }}"><i
                                                            style="color: #ffc107" class="far fa-eye "></i>&nbsp;
                                                        {{ trans('trans-parent.show_result_student') }}
                                                    </a>
                                                    <a class="dropdown-item" href="{{ route('parent.children.attendance', $son->id) }}"><i
                                                            style="color: rgb(27, 129, 129)" class="far fa-edit "></i>&nbsp;
                                                        {{ trans('trans-parent.show_attendance_student') }}
                                                    </a>

                                                </div>
                                            </div>
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
    <script>
        $(document).ready(function() {

            function fetchFilteredData() {
                var gender = $('#filter_gender').val();
                var grade = $('#filter_grade').val();
                let currentLang = "{{ app()->getLocale() }}";

                $.ajax({
                    url: "{{ route('parent.children.filter') }}",
                    method: "GET",
                    data: {
                        gender: gender,
                        grade: grade
                    },
                    success: function(response) {
                        $('#filteration').empty(); // clear tbody

                        if (response.data.length === 0) {
                            $('#filteration').append(
                                "<tr><td colspan='10'>{{ trans('trans-parent.no_data_found') }}</td></tr>"
                            );
                            return;
                        }

                        $.each(response.data, function(index, son) {
                            $('#filteration').append(`
                            <tr>
                                <td>${index + 1}</td>
                                <td>${son.name[currentLang]}</td>
                                <td>${son.email ?? '-'}</td>
                                <td>${son.academic_year ?? '-'}</td>
                                <td>${son.date_birth ?? '-'}</td>
                                <td>${son.type_blood_name ?? '-'}</td>
                                <td>${son.gender_name[currentLang] ?? '-'}</td>
                                <td>${son.grade_name[currentLang] ?? '-'}</td>
                                <td>${son.class_name[currentLang] ?? '-'}</td>
                                <td>${son.section_name[currentLang] ?? '-'}</td>
                                <td>
                                    <div class="dropdown show">
                                                <a class="btn btn-success btn-sm dropdown-toggle" href="#"
                                                    role="button" id="dropdownMenuLink" data-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false">
                                                    {{ trans('trans.processes') }}
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">

                                                    <a class="dropdown-item"
                                                        href="${`children/result/${son.id}`}"><i
                                                            style="color: #ffc107" class="far fa-eye "></i>&nbsp;
                                                        {{ trans('trans-parent.show_result_student') }}
                                                    </a>
                                                    <a class="dropdown-item"
                                                        href="${`children/attendance/${son.id}`}"><i
                                                            style="color: rgb(27, 129, 129)" class="far fa-edit "></i>&nbsp;
                                                        {{ trans('trans-parent.show_attendance_student') }}
                                                    </a>
                                                </div>  
                                </td>
                            </tr>
                        `);
                        });
                    }
                });
            }

            $('#filter_gender').on('change', fetchFilteredData);
            $('#filter_grade').on('change', fetchFilteredData);

        });
    </script>
@endsection
