 <!--اضافة قسم جديد -->
 <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" style="font-family: 'Cairo', sans-serif;" id="exampleModalLabel">
                     {{ trans('trans.add_section') }}</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">

                 <form action="{{ route('sections.store') }}" method="POST">
                     @csrf
                     <div class="row">
                         <div class="col">
                             <input type="text" name="name_section" class="form-control"
                                 placeholder="{{ trans('trans.section_name_ar') }}">
                         </div>

                         <div class="col">
                             <input type="text" name="name_section_en" class="form-control"
                                 placeholder="{{ trans('trans.section_name_en') }}">
                         </div>
                     </div>
                     <br>

                     <!-- اختيار المرحلة الدراسية -->
                    <div class="col">
                        <label for="inputName" class="control-label">{{ trans('trans.name_grade') }}</label>
                        <select name="grade_id" class="custom-select">
                            <option value="" selected disabled>{{ trans('trans.select_grade') }}</option>
                            @foreach ($grades as $list_grade)
                                <option value="{{ $list_grade->id }}"> {{ $list_grade->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <br>

                   <!-- اختيار الصف الدراسي -->
                    <div class="col">
                        <label for="inputName" class="control-label">{{ trans('trans.name_class') }}</label>
                        <select name="classe_id" class="custom-select">
                           
                        </select>
                    </div><br>

                    <!-- اختيار المعلمين التابعين للقسم -->
                    <div class="col">
                        <label for="inputName" class="control-label">{{ trans('trans.name_teacher') }}</label>
                        <select multiple name="teacher_id[]" class="form-control" id="exampleFormControlSelect2">
                            @foreach($teachers as $teacher)
                                <option value="{{$teacher->id}}">{{$teacher->name}}</option>
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