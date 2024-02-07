import './bootstrap';
import {createApp} from 'vue'
import app from './app.vue'
import 'bootstrap/dist/css/bootstrap.min.css'
import bootstrap from 'bootstrap/dist/js/bootstrap.min.js'
createApp(app).use(bootstrap).mount("#app")
