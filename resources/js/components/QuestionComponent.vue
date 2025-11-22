<template>
  <div v-if="questions.length">
        <h5>
            {{ $t('count_question') }} {{ totalQuestions }} {{ $t('questions') }}
        </h5>
    <div class="card card-statistics mb-30">
      <div class="card-body">
        <h5 class="card-title">{{ counter + 1 }} - {{ currentQuestion.title }}</h5>

        <div v-for="(answer, index) in currentAnswers" :key="index" class="custom-control custom-radio">
          <input type="radio" :id="'customRadio' + index" name="customRadio" class="custom-control-input"
            :value="answer" v-model="selectedAnswer" />
          <label class="custom-control-label" :for="'customRadio' + index">
            {{ answer }}
          </label>
        </div>

        <!-- الأزرار -->
        <div class="d-flex justify-content-between mt-4">
          <button v-if="counter > 0" class="btn btn-secondary" @click="prevQuestion">
            السابق
          </button>

          <button v-if="selectedAnswer" class="btn btn-primary ms-auto" @click="nextQuestion">
            {{ isLastQuestion ? 'إنهاء' : 'التالي' }}
          </button>
        </div>
      </div>
    </div>
  </div>

  <div v-else>
    <p>Loading questions...</p>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  props: {
    quizzeId: {
      type: [Number, String],
      required: true,
    },
    studentId: {
      type: [Number, String],
      required: true,
    },
  },
  data() {
    return {
      questions: [],
      counter: 0,
      selectedAnswer: null,
      answersMap: {}, // هنا بنخزن كل إجابات المستخدم
      question_id: '',
      totalQuestions: 0
    };
  },
  computed: {
    currentQuestion() {
      return this.questions[this.counter] || {};
    },
    currentAnswers() {
      if (!this.currentQuestion.answers) return [];
      return this.currentQuestion.answers.split('-');
    },
    isLastQuestion() {
      return this.counter === this.questions.length - 1;
    },
  },
  watch: {
    // كل ما السؤال الحالي يتغير
    counter() {
      const currentId = this.currentQuestion.id;
      this.selectedAnswer = this.answersMap[currentId] || null;
    },
    // لما المستخدم يختار إجابة جديدة نخزنها
    selectedAnswer(newVal) {
      if (newVal && this.currentQuestion.id) {
        this.answersMap[this.currentQuestion.id] = newVal;
      }
    },
  },
  mounted() {
    this.fetchQuestions();
  },
  methods: {
    async fetchQuestions() {
      try {
        const response = await axios.get(
          `/students/exams/${this.quizzeId}/questions`
        );
        this.questions = response.data.questions;
        this.totalQuestions = this.questions.length;
      } catch (error) {
        console.error('Error fetching questions:', error);
      }
    },
    nextQuestion() {
      if (this.isLastQuestion) {
        const ok = confirm(this.$t('are_you_sure_submit'));

        if(!ok) {
          return;
        }

        this.submitAnswers();
        window.location.href = `/students/exams`;
        return;
      }
      this.counter++;
    },
    prevQuestion() {
      if (this.counter > 0) {
        this.counter--;
      }
    },
    submitAnswers() {
      // نحول answersMap من object إلى array
      const formattedAnswers = Object.entries(this.answersMap).map(([question_id, answer]) => ({
        question_id,
        answer,
      }));

      axios.post(`/students/exams/${this.quizzeId}/answers`, {
        student_id: this.studentId,
        answers: formattedAnswers,
        quizze_id: this.quizzeId
      })
        .then(response => {
          console.log(response.data);
        })
        .catch(error => {
          console.error(error.response?.data || error);
          alert('حدث خطأ أثناء الحفظ');
        });
    }

  },
};
</script>

<style scoped>
.btn {
  min-width: 100px;
}
</style>
