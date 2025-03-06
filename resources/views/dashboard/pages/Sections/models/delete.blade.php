   <!-- delete_modal_Grade -->
   <div class="modal fade"
   id="delete{{ $list_sections->id }}"
   tabindex="-1" role="dialog"
   aria-labelledby="exampleModalLabel"
   aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 style="font-family: 'Cairo', sans-serif;"
                  class="modal-title"
                  id="exampleModalLabel">
                  {{ trans('trans.delete_Section') }}
              </h5>
              <button type="button" class="close"
                      data-dismiss="modal"
                      aria-label="Close">
              <span
                  aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
              <form
                  action="{{ route('sections.destroy', $list_sections->id) }}"
                  method="post">
                  @csrf
                  @method('delete')
                  {{ trans('trans.warning_section') }}
                  <input id="id" type="hidden"
                         name="id"
                         class="form-control"
                         value="{{ $list_sections->id }}">
                  <div class="modal-footer">
                      <button type="button"
                              class="btn btn-secondary"
                              data-dismiss="modal">{{ trans('trans.close') }}</button>
                      <button type="submit"
                              class="btn btn-danger">{{ trans('trans.submit') }}</button>
                  </div>
              </form>
          </div>
      </div>
  </div>
</div>
