<?php
namespace App\Livewire;

use App\Models\Question as ModelsQuestion;
use Livewire\Component;
class Question extends Component
{
    public $quizze_id, $student_id, $data, $counter = 0;

    public function render()
    {
        $this->data = ModelsQuestion::where('quizze_id', $this->quizze_id)->get();
        return view('livewire.question');
    }

    public function nextQuestion()
    {
        dd('test');
    }
}