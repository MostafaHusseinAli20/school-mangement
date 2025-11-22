<div class="modal fade" id="cancel_exam{{ $result->id }}" tabindex="-1" role="dialog" 
    aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{ route('teacher.quizzes.cancelled.exam.for.student', 
            [$quiz->id, $result->student_id]) }}" method="post">
            @csrf
            @method('delete')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" 
                    id="exampleModalLabel">
                        {{ trans('trans.cancelled_quizze_student') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p> {{ trans('trans.warning_cancel_exam') }} {{ $result->student->name }}</p>
                </div>
                <div class="modal-footer">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">{{ trans('trans.close') }}</button>
                        <button type="submit" class="btn btn-danger">{{ trans('trans.submit') }}</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
