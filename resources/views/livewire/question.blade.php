<div>
    <div>
        <div class="card card-statistics mb-30">
            <div class="card-body">
                <h5 class="card-title">{{ $data[$counter]->title }}</h5>

                @foreach (preg_split('/(-)/', $data[$counter]->answers) as $index => $answer)
                    <div class="custom-control custom-radio">
                        <input type="radio" name="customRadio"
                            id="customRadio{{ $index }}"
                            class="custom-control-input"
                            wire:click="nextQuestion()">

                        <label class="custom-control-label" for="customRadio{{ $index }}">
                            {{ $answer }}
                        </label>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- لو فيه رسالة بعد انتهاء الأسئلة --}}
        @if (session()->has('message'))
            <div class="alert alert-success mt-3">
                {{ session('message') }}
            </div>
        @endif
    </div>
</div>
