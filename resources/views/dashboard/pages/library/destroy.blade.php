<div class="modal fade" id="delete_book{{$book->id}}" tabindex="-1"
    role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
       <form action="{{route('library.destroy',$book->id)}}" method="post">
           @method('delete')
           @csrf
           <div class="modal-content">
               <div class="modal-header">
                   <h5 style="font-family: 'Cairo', sans-serif;"
                       class="modal-title" id="exampleModalLabel">{{ trans('trans.delete_book') }}</h5>
                   <button type="button" class="close" data-dismiss="modal"
                           aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                   </button>
               </div>
               <div class="modal-body">
                   <p> {{ trans('trans.warning_grade') }} <span class="text-danger">{{$book->title}}</span></p>
                   <input type="hidden" name="id" value="{{$book->id}}">
                   <input type="hidden" name="file_name" value="{{$book->file_name}}">
               </div>
               <div class="modal-footer">
                   <div class="modal-footer">
                       <button type="button" class="btn btn-secondary"
                               data-dismiss="modal">{{ trans('trans.close') }}</button>
                       <button type="submit"
                               class="btn btn-danger">{{ trans('trans.submit') }}</button>
                   </div>
               </div>
           </div>
       </form>
   </div>
</div>