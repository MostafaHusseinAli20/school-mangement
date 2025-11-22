@extends('dashboard.layouts.master')
@section('css')
    @toastr_css
@endsection

@section('content')
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">

                @if (session()->has('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>{{ session()->get('error') }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="col-xs-12">
                    <div class="col-md-12">
                        <br>
                        <form action="{{ route('teacher.quizzes.update', $quizze->id) }}" method="post" autocomplete="off">
                            @csrf
                            @method('PUT')
                            <div class="form-row">
                                <div class="col">
                                    <label for="title">{{ trans('trans.quizze_name_ar') }}</label>
                                    <input type="text" name="name_ar" class="form-control" value="{{ $quizze->getTranslation('name','ar') }}">
                                </div>

                                <div class="col">
                                    <label for="title">{{ trans('trans.quizze_name_en') }}</label>
                                    <input type="text" name="name_en" class="form-control" value="{{ $quizze->getTranslation('name','en') }}">
                                </div>
                            </div>
                            <br>

                            <div class="form-row">

                                <div class="col">
                                    <div class="form-group">
                                        <label for="Grade_id">{{ trans('trans.subject_material') }} : <span
                                                class="text-danger">*</span></label>
                                        <select class="custom-select mr-sm-2" name="subject_id">
                                            <option selected disabled>{{ trans('trans.Choose') }}...</option>
                                            @foreach ($subjects as $subject)
                                                <option {{ $quizze->subject_id == $subject->id ? 'selected' : '' }} 
                                                    value="{{ $subject->id }}">{{ $subject->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                            </div>

                            <div class="form-row">

                                <div class="col">
                                    <div class="form-group">
                                        <label for="grade_id">{{ trans('trans.grade') }} : <span
                                                class="text-danger">*</span></label>
                                        <select class="custom-select mr-sm-2" name="grade_id">
                                            <option selected disabled>{{ trans('trans.Choose') }}...</option>
                                            @foreach ($grades as $grade)
                                                <option {{ $quizze->grade_id == $grade->id ? 'selected' : '' }} 
                                                    value="{{ $grade->id }}">{{ $grade->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-group">
                                        <label for="classe_id">{{ trans('trans.classes') }} : <span
                                                class="text-danger">*</span></label>
                                        <select class="custom-select mr-sm-2" name="classe_id">
                                            <option value="{{$quizze->classe_id}}">{{ $quizze->classe->classe_name }}</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-group">
                                        <label for="section_id">{{ trans('trans.section') }} : </label>
                                        <select class="custom-select mr-sm-2" name="section_id">
                                            <option value="{{$quizze->section_id}}">{{ $quizze->section->name_section }}</option>
                                        </select>
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
    </div>
</div>
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