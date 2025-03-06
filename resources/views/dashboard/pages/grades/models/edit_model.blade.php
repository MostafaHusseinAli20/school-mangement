 <!-- edit_modal_Grade -->
 <div class="modal fade" id="edit{{ $grade->id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                    id="exampleModalLabel">
                    {{ trans('trans.edit') }}
                </h5>
                <button type="button" class="close" data-dismiss="modal"
                    aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">



                <!-- add_form -->
                <form action="{{ route('grades.update', $grade->id) }}" method="post">
                    @csrf
                    @method('patch')
                    <div class="row">
                        <div class="col">
                            <label for="name"
                                class="mr-sm-2">{{ trans('trans.grade_name_ar') }}
                                :</label>
                            <input id="name" type="text" name="name"
                                class="form-control"
                                value="{{ $grade->getTranslation('name', 'ar') }}"
                                required>
                            <input id="id" type="hidden" name="id"
                                class="form-control" value="{{ $grade->id }}">
                        </div>
                        <div class="col">
                            <label for="name_en"
                                class="mr-sm-2">{{ trans('trans.grade_name_en') }}
                                :</label>
                            <input type="text" class="form-control"
                                value="{{ $grade->getTranslation('name', 'en') }}"
                                name="name_en" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label
                            for="exampleFormControlTextarea1">{{ trans('trans.notes') }}
                            :</label>
                        <textarea class="form-control" name="notes" id="exampleFormControlTextarea1" rows="3">{{ $grade->notes }}</textarea>
                    </div>
                    <br><br>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">{{ trans('trans.close') }}</button>
                        <button type="submit"
                            class="btn btn-success">{{ trans('trans.submit') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>