<!--تعديل قسم جديد -->
<div class="modal fade" id="edit{{ $list_sections->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="font-family: 'Cairo', sans-serif;" id="exampleModalLabel">
                    {{ trans('trans.edit_Section') }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form action="{{ route('sections.update', $list_sections->id) }}" method="POST">
                    @csrf
                    @method('patch')
                    <div class="row">
                        <div class="col">
                            <input type="text" name="name_section" class="form-control"
                                value="{{ $list_sections->getTranslation('name_section', 'ar') }}">
                        </div>

                        <div class="col">
                            <input type="text" name="name_section_en" class="form-control"
                                value="{{ $list_sections->getTranslation('name_section', 'en') }}">
                            <input id="id" type="hidden" name="id" class="form-control"
                                value="{{ $list_sections->id }}">
                        </div>

                    </div>
                    <br>


                    <div class="col">
                        <label for="inputName" class="control-label">{{ trans('trans.name_grade') }}</label>
                        <select name="grade_id" class="custom-select" onclick="console.log($(this).val())">
                            <!--placeholder-->
                            <option value="{{ $grade->id }}">
                                {{ $grade->name }}
                            </option>
                            @foreach ($list_grades as $list_grade)
                                <option value="{{ $list_grade->id }}">
                                    {{ $list_grade->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <br>

                    <div class="col">
                        <label for="inputName" class="control-label">{{ trans('trans.name_class') }}</label>
                        <select name="classe_id" class="custom-select">
                            <option value="{{ $list_sections->classes->id }}">
                                {{ $list_sections->classes->classe_name }}
                            </option>
                        </select>
                    </div>
                    <br>

                    <div class="col">
                        <div class="form-check">

                            @if ($list_sections->status === 1)
                                <input type="checkbox" checked class="form-check-input" name="status"
                                    id="exampleCheck1">
                            @else
                                <input type="checkbox" class="form-check-input" name="status" id="exampleCheck1">
                            @endif
                            <label class="form-check-label" for="exampleCheck1">{{ trans('trans.status') }}</label>
                        </div>
                    </div><br>

                    {{-- Foreach for Name Teachers --}}
                    <div class="col">
                        <label for="inputName" class="control-label">{{ trans('trans.name_teacher') }}</label>
                        <select multiple name="teacher_id[]" class="form-control" id="exampleFormControlSelect2">
                            @foreach ($list_sections->teachers as $teacher)
                                <option selected value="{{ $teacher['id'] }}">{{ $teacher['name'] }}</option>
                            @endforeach

                            @foreach ($teachers as $teacher)
                                <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                            @endforeach
                        </select>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                    data-dismiss="modal">{{ trans('trans.close') }}</button>
                <button type="submit" class="btn btn-danger">{{ trans('trans.submit') }}</button>
            </div>
            </form>
        </div>
    </div>
</div>
