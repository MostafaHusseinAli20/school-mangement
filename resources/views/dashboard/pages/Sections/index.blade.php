@extends('dashboard.layouts.master')

@section('title', __('trans.school_mangement_system') . ' | ' . __('trans.sections'))

@section('css')
    @toastr_css
@endsection

@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <a class="button x-small" href="#" data-toggle="modal" data-target="#exampleModal">
                        @lang('trans.add_section')</a>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">

                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>

                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <div class="card card-statistics h-100">
                    <div class="card-body">
                        <div class="accordion gray plus-icon round">

                            @foreach ($grades as $grade)
                                <div class="acd-group">
                                    <a href="#" class="acd-heading">{{ $grade->name }}</a>
                                    <div class="acd-des">

                                        <div class="row">
                                            <div class="col-xl-12 mb-30">
                                                <div class="card card-statistics h-100">
                                                    <div class="card-body">
                                                        <div class="d-block d-md-flex justify-content-between">
                                                            <div class="d-block">
                                                            </div>
                                                        </div>
                                                        <div class="table-responsive mt-15">
                                                            <table class="table center-aligned-table mb-0">
                                                                <thead>
                                                                    <tr class="text-dark">
                                                                        <th>#</th>
                                                                        <th>{{ trans('trans.name_section') }}
                                                                        </th>
                                                                        <th>{{ trans('trans.name_class') }}</th>
                                                                        <th>{{ trans('trans.status') }}</th>
                                                                        <th>{{ trans('trans.processes') }}</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @php
                                                                        $i = 0;
                                                                    @endphp
                                                                    @foreach ($grade->sections as $list_sections)
                                                                        <tr>
                                                                            @php
                                                                                $i++;
                                                                            @endphp
                                                                            <td>{{ $i }}</td>
                                                                            <td>{{ $list_sections->name_section }}</td>
                                                                            <td>{{ $list_sections->classes->classe_name	 }}
                                                                            </td>
                                                                            <td>
                                                                                @if ($list_sections->status === 1)
                                                                                    <label
                                                                                        class="badge badge-success">{{ trans('trans.status_section_ac') }}</label>
                                                                                @else
                                                                                    <label
                                                                                        class="badge badge-danger">{{ trans('trans.status_section_no') }}</label>
                                                                                @endif

                                                                            </td>
                                                                            <td>

                                                                                <a href="#"
                                                                                    class="btn btn-outline-info btn-sm"
                                                                                    data-toggle="modal"
                                                                                    data-target="#edit{{ $list_sections->id }}">{{ trans('trans.edit') }}</a>
                                                                                <a href="#"
                                                                                    class="btn btn-outline-danger btn-sm"
                                                                                    data-toggle="modal"
                                                                                    data-target="#delete{{ $list_sections->id }}">{{ trans('trans.delete') }}</a>
                                                                            </td>
                                                                        </tr>


                                                                        @include('dashboard.pages.Sections.models.edit')

                                                                        @include('dashboard.pages.Sections.models.delete')
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                @include('dashboard.pages.Sections.models.add_model')

            </div>
        </div>
    </div>
    </div>
@endsection

@section('js')
    @toastr_js
    @toastr_render
    <script>
        $(document).ready(function () {
            $('select[name="grade_id"]').on('change', function () {
                var Grade_id = $(this).val();
                if (Grade_id) {
                    $.ajax({
                        url: "{{ URL::to('classes') }}/" + Grade_id,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            $('select[name="classe_id"]').empty();
                            $.each(data, function (key, value) {
                                $('select[name="classe_id"]').append('<option value="' + key + '">' + value + '</option>');
                            });
                        },
                    });
                } else {
                    console.log('AJAX load did not work');
                }
            });
        });

    </script>

@endsection