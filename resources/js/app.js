import './bootstrap';
import { createApp } from 'vue';
import { createI18n } from 'vue-i18n';
import QuestionComponent from './components/QuestionComponent.vue';

const app = createApp({});

app.component('question-component', QuestionComponent);

export const langCurrent = document.getElementsByTagName('html')[0].lang;
import ar from './locales/ar.json';
import en from './locales/en.json';

app.use(
    createI18n({
        locale: langCurrent,
        fallbackLocale: 'en',
        messages: { ar, en },
    }))
    .mount('#app');