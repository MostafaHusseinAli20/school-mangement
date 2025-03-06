<!-- edit_modal_Grade -->
<div class="modal fade" id="edit{{ $classes->id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
       <div class="modal-content">
           <div class="modal-header">
               <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                   id="exampleModalLabel">
                   {{ trans('My_Classes_trans.edit_class') }}
               </h5>
               <button type="button" class="close" data-dismiss="modal"
                       aria-label="Close">
                   <span aria-hidden="true">&times;</span>
               </button>
           </div>
           <div class="modal-body">
               <!-- edit_form -->
               <form action="{{ route('classes.update', $classes->id) }}" method="POST">
                   @csrf
                   @method('patch')
                   <div class="row">
                       <div class="col">
                           <label for="classe_name"
                                  class="mr-sm-2">@lang('trans.class_name_ar')
                               :</label>
                           <input id="classe_name" type="text" name="classe_name"
                                  class="form-control"
                                  value="{{ $classes->getTranslation('classe_name', 'ar') }}"
                                  required>
                           <input id="id" type="hidden" name="id" class="form-control"
                                  value="{{ $classes->id }}">
                       </div>
                       <div class="col">
                           <label for="classe_name_en"
                                  class="mr-sm-2">{{ trans('trans.class_name_en') }}
                               :</label>
                           <input type="text" class="form-control"
                                  value="{{ $classes->getTranslation('classe_name', 'en') }}"
                                  name="classe_name_en" required>
                       </div>
                   </div><br>
                   <div class="form-group">
                       <label
                           for="exampleFormControlTextarea1">@lang('trans.name_class')
                           :</label>
                       <select class="form-control form-control-lg"
                               id="exampleFormControlSelect1" name="grade_id">
                           <option value="{{ $classes->grades->id }}" >
                               {{ $classes->grades->name }}
                           </option>
                           @foreach ($grades as $grade)
                               <option value="{{ $grade->id }}">
                                   {{ $grade->name }}
                               </option>
                           @endforeach
                       </select>

                   </div>
                   <br><br>

                   <div class="modal-footer">
                       <button type="button" class="btn btn-secondary"
                               data-dismiss="modal">@lang('trans.close')</button>
                       <button type="submit"
                               class="btn btn-success">@lang('trans.submit')</button>
                   </div>
               </form>

           </div>
       </div>
   </div>
</div>