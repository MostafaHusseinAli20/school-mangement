@extends('dashboard.layouts.master')

@section('title', __('trans.school_mangement_system') . ' | ' . __('trans.classes_list'))

@section('css')
    @toastr_css
@endsection

@section('content')
    <div class="row">

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
                        @lang('trans.add_class')
                    </button>

                    <button type="button" class="button x-small" id="btn_delete_all">
                        @lang('trans.delete_checkbox')
                    </button>
    

                    <br><br>

                    <form action="{{ route('filter_classe') }}" method="POST">
                        @csrf
                        <select style="width: 20%; margin-bottom: 10px" class="form-control selectpicker p-2" data-style="btn-info" name="grade_id" required
                                onchange="this.form.submit()">
                            <option value="" selected disabled>@lang('trans.search_by_grade')</option>
                            @foreach ($grades as $grade)
                                <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                            @endforeach
                        </select>
                    </form>

                    <div class="table-responsive">
                        <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                            style="text-align: center">
                            <thead>
                                <tr>
                                    <th><input name="select_all" id="example-select-all" type="checkbox" onclick="CheckAll('box1', this)" /></th>
                                    <th>#</th>
                                    <th>@lang('trans.name_class')</th>
                                    <th>@lang('trans.name_grade')</th>
                                    <th>@lang('trans.processes')</th>
                                </tr>
                            </thead>
                            <tbody>


                                @if (isset($details))

                                    <?php $classes_list = $details; ?>
                                @else

                                    <?php $classes_list = $classes; ?>
                                @endif

                                <?php $i = 0; ?>
                                @foreach ($classes_list as $classes)
                                    <tr>
                                        <?php $i++; ?>
                                        <td><input type="checkbox"  value="{{ $classes->id }}" class="box1" ></td>
                                        <td>{{ $i }}</td>
                                        <td>{{ $classes->classe_name }}</td>
                                        <td>{{ $classes->grades->name }}</td>
                                        <td>
                                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                                data-target="#edit{{ $classes->id }}" title="@lang('trans.edit')"><i
                                                    class="fa fa-edit"></i></button>
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                data-target="#delete{{ $classes->id }}" title="@lang('trans.delete')"><i
                                                    class="fa fa-trash"></i></button>
                                        </td>
                                    </tr>

                                    @include('dashboard.pages.classes.models.edit_model')

                                    @include('dashboard.pages.classes.models.delete_model')
                                @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>


        @include('dashboard.pages.classes.models.add_model')


        <!-- حذف مجموعة صفوف -->
        <div class="modal fade" id="delete_all" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                            @lang('trans.delete_classe')
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form action="{{ route('delete_all') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            @lang('trans.warning_grade')
                            <input class="text" type="hidden" id="delete_all_id" name="delete_all_id" value=''>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                data-dismiss="modal">@lang('trans.close')</button>
                            <button type="submit" class="btn btn-danger">@lang('trans.submit')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


    </div>
    </div>

    </div>
@endsection

@section('js')
    @toastr_js
    @toastr_render

    <script type="text/javascript">
        $(function() {
            $("#btn_delete_all").click(function() {
                var selected = new Array();
                $("#datatable input[type=checkbox]:checked").each(function() {
                    selected.push(this.value);
                });

                if (selected.length > 0) {
                    $('#delete_all').modal('show')
                    $('input[id="delete_all_id"]').val(selected);
                }
            });
        });
    </script>

@endsection
