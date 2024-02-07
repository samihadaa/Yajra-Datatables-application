import { createRouter, createWebHistory } from 'vue-router'
import AddTodo from '../components/AddTodo.vue'
import TodoList from '../components/TodoList.vue'
const routes = [
    {
        name:'TodoList',
        path:'/',
        component:TodoList
    },
    {
        name:'AddTodo',
        path:'/add_todo',
        component:AddTodo
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router
