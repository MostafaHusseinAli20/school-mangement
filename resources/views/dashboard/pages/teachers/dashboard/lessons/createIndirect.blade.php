@extends('dashboard.layouts.master')

@section('title', __('trans.school_mangement_system') . ' | ' . __('trans.onlineclasses_indirect_create'))

@section('css')
    @toastr_css
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

                    <form method="post" action="{{ route('teacher.online.indirect_store') }}" autocomplete="off">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>{{ trans('trans.grade') }} : <span
                                            class="text-danger">*</span></label>
                                    <select class="custom-select mr-sm-2" name="grade_id">
                                        <option selected disabled>{{ trans('trans.Choose') }}...</option>
                                        @foreach ($grades as $grade)
                                            <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="Classroom_id">{{ trans('trans.classes') }} : <span
                                            class="text-danger">*</span></label>
                                    <select class="custom-select mr-sm-2" name="classe_id">

                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="section_id">{{ trans('trans.section') }} : </label>
                                    <select class="custom-select mr-sm-2" name="section_id">

                                    </select>
                                </div>
                            </div>
                        </div><br>

                        <div class="row">

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>{{ trans('trans.onlineclass_meeting_id') }} : <span class="text-danger">*</span></label>
                                    <input class="form-control" name="meeting_id" type="number">
                                </div>
                            </div>


                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>{{ trans('trans.onlineclass_name') }} : <span class="text-danger">*</span></label>
                                    <input class="form-control" name="meeting_topic" type="text">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>{{ trans('trans.onlineclass_date') }} : <span class="text-danger">*</span></label>
                                    <input class="form-control" type="datetime-local" name="meeting_start_at">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>{{ trans('trans.onlineclass_time') }} : <span class="text-danger">*</span></label>
                                    <input class="form-control" name="meeting_duration" type="number">
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>{{ trans('trans.onlineclass_password') }} : <span class="text-danger">*</span></label>
                                    <input class="form-control" name="meeting_password" type="text">
                                </div>
                            </div>


                        </div>

                        <div class="row">

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>{{ trans('trans.start_url') }} : <span class="text-danger">*</span></label>
                                    <input class="form-control" name="start_url" type="text">
                                </div>
                            </div>

                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>{{ trans('trans.join_url') }} : <span class="text-danger">*</span></label>
                                    <input class="form-control" name="join_url" type="text">
                                </div>
                            </div>
                        </div>

                        <button class="btn btn-success btn-sm nextBtn btn-lg pull-right"
                            type="submit">{{ trans('trans.submit') }}</button>
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
    <script>
    $(document).ready(function() {

        // عند تغيير المرحلة (Grade)
        $('select[name="grade_id"]').on('change', function() {
            const grade_id = $(this).val();

            if (grade_id) {
                $.ajax({
                    url: "{{ url('teachers/classes') }}/" + grade_id,
                    type: "GET",
                    dataType: "json",
                    beforeSend: function() {
                        $('select[name="classe_id"]').html(
                            '<option value="">جارِ التحميل...</option>');
                    },
                    success: function(data) {
                        const classSelect = $('select[name="classe_id"]');
                        classSelect.empty().append('<option value="">اختر الصف</option>');

                        $.each(data, function(key, value) {
                            classSelect.append(
                                `<option value="${key}">${value}</option>`);
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error('حدث خطأ أثناء تحميل الصفوف:', error);
                    }
                });
            } else {
                $('select[name="classe_id"]').empty().append('<option value="">اختر الصف</option>');
            }
        });

        // عند تغيير الصف (Class)
        $('select[name="classe_id"]').on('change', function() {
            const classe_id = $(this).val();

            if (classe_id) {
                $.ajax({
                    url: "{{ url('teachers/get_sections') }}/" + classe_id,
                    type: "GET",
                    dataType: "json",
                    beforeSend: function() {
                        $('select[name="section_id"]').html(
                            '<option value="">جارِ التحميل...</option>');
                    },
                    success: function(data) {
                        const sectionSelect = $('select[name="section_id"]');
                        sectionSelect.empty().append(
                        '<option value="">اختر القسم</option>');

                        $.each(data, function(key, value) {
                            sectionSelect.append(
                                `<option value="${key}">${value}</option>`);
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error('حدث خطأ أثناء تحميل الأقسام:', error);
                    }
                });
            } else {
                $('select[name="section_id"]').empty().append('<option value="">اختر القسم</option>');
            }
        });

    });
</script>
@endsection
