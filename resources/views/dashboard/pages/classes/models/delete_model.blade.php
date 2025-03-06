  <!-- delete_modal_Grade -->
  <div class="modal fade" id="delete{{ $classes->id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
       <div class="modal-content">
           <div class="modal-header">
               <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                   id="exampleModalLabel">
                   @lang('trans.delete_classe')
               </h5>
               <button type="button" class="close" data-dismiss="modal"
                       aria-label="Close">
                   <span aria-hidden="true">&times;</span>
               </button>
           </div>
           <div class="modal-body">
               <form action="{{ route('classes.destroy', $classes->id) }}"
                     method="post">
                     @csrf
                     @method('delete')
                   {{ trans('trans.warning_grade') }}
                   <input id="id" type="hidden" name="id" class="form-control"
                          value="{{ $classes->id }}">
                   <div class="modal-footer">
                       <button type="button" class="btn btn-secondary"
                               data-dismiss="modal">@lang('trans.close')</button>
                       <button type="submit"
                               class="btn btn-danger">@lang('trans.submit')</button>
                   </div>
               </form>
           </div>
       </div>
   </div>
</div>