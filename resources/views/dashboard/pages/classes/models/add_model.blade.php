<!-- add_modal_class -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                    @lang('trans.add_class')
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form class=" row mb-30" action="{{ route('classes.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="repeater">
                            <div data-repeater-list="classes_list">
                                <div data-repeater-item>
                                    <div class="row">

                                        <div class="col">
                                            <label for="classe_name"
                                                class="mr-sm-2">@lang('trans.class_name_ar')
                                                :</label>
                                            <input  class="form-control" type="text" name="classe_name" />
                                        </div>


                                        <div class="col">
                                            <label for="classe_name_en"
                                                class="mr-sm-2">@lang('trans.class_name_en')
                                                :</label>
                                            <input  class="form-control" type="text" name="classe_name_en" />
                                        </div>


                                        <div class="col">
                                            <label for="grade_id"
                                                class="mr-sm-2">@lang('trans.name_grade')
                                                :</label>

                                            <div class="box">
                                                <select class="fancyselect" name="grade_id">
                                                    @foreach ($grades as $grade)
                                                        <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                        </div>

                                        <div class="col">
                                            <label for="classe_name_en"
                                                class="mr-sm-2">@lang('trans.processes')
                                                :</label>
                                            <input  class="btn btn-danger btn-block" data-repeater-delete
                                                type="button" value="@lang('trans.delete_row')" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-20">
                                <div class="col-12">
                                    <input class="button" data-repeater-create type="button" value="@lang('trans.add_row')"/>
                                </div>

                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                    data-dismiss="modal">@lang('trans.close')</button>
                                <button type="submit"
                                    class="btn btn-success">@lang('trans.submit')</button>
                            </div>


                        </div>
                    </div>
                </form>
            </div>


        </div>

    </div>

</div>