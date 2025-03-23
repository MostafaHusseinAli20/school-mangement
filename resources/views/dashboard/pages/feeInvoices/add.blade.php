@extends('dashboard.layouts.master')
@section('title', __('trans.school_mangement_system') . ' | ' . __('trans.study_fees'))
    
@section('css')
    @toaster_css
@endsection

@section('content')
       <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
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

                        <form class=" row mb-30" action="{{ route('fee-invoices.store') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="repeater">
                                    <div data-repeater-list="List_Fees">
                                        <div data-repeater-item>
                                            <div class="row">

                                                <div class="col">
                                                    <label class="mr-sm-2">{{ trans('trans.student_name') }}</label>
                                                    <select class="fancyselect" name="student_id" required>
                                                            <option value="{{ $student->id }}">{{ $student->name }}</option>
                                                    </select>
                                                </div>

                                                <div class="col">
                                                    <label for="" class="mr-sm-2">{{ trans('trans.fee_type') }}</label>
                                                    <div class="box">
                                                        <select class="fancyselect" name="fee_id" required>
                                                            <option value="">{{ trans('trans.Choose') }}</option>
                                                            @foreach($fees as $fee)
                                                                <option value="{{ $fee->id }}">{{ $fee->title }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                </div>

                                                <div class="col">
                                                    <label for="" class="mr-sm-2">{{ trans('trans.amount') }}</label>
                                                    <div class="box">
                                                        <select class="fancyselect" name="amount" required>
                                                            <option value="">{{ trans('trans.Choose') }}</option>
                                                            @foreach($fees as $fee)
                                                                <option value="{{ $fee->amount }}">{{ $fee->amount }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col">
                                                    <label for="description" class="mr-sm-2">{{ trans('trans.statement') }}</label>
                                                    <div class="box">
                                                        <input type="text" class="form-control" name="description" required>
                                                    </div>
                                                </div>

                                                <div class="col">
                                                    <label for="Name_en" class="mr-sm-2">{{ trans('trans.processes') }}:</label>
                                                    <input class="btn btn-danger btn-block" data-repeater-delete type="button" value="{{ trans('trans.delete_row') }}" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-20">
                                        <div class="col-12">
                                            <input class="button" data-repeater-create type="button" value="{{ trans('trans.add_row') }}"/>
                                        </div>
                                    </div><br>
                                    <input type="hidden" name="grade_id" value="{{$student->grade_id}}">
                                    <input type="hidden" name="classe_id" value="{{$student->classe_id}}">

                                    <button type="submit" class="btn btn-primary">{{ trans('trans.sure_data') }}</button>
                                </div>
                            </div>
                        </form>

                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection

@section('js')
    @toastr_js
    @toastr_render

    {{-- <script>
        $(document).ready(function () {
            $('select[name="fee_id"]').on('change', function () {
                var fee_id = $(this).val();
                if (fee_id) {
                    $.ajax({
                        url: "{{ URL::to('fee_type') }}/" + fee_id,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            $('select[name="amount"]').empty();
                            $.each(data, function (key, value) {
                                $('select[name="amount"]').append('<option value="' + key + '">' + value + '</option>');
                            });
                        },
                    });
                } else {
                    console.log('AJAX load did not work');
                }
            });
        });

    </script> --}}

@endsection