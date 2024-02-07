import './bootstrap';
import {createApp} from 'vue'
import app from './app.vue'
//Import Bootstrap
import 'bootstrap/dist/css/bootstrap.min.css'
import bootstrap from 'bootstrap/dist/js/bootstrap.min.js'
//Import router
import router from './router/index.js'
createApp(app).use(router).use(bootstrap).mount("#app")
