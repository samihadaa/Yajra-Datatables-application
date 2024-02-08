import { createRouter, createWebHistory } from 'vue-router'
import EditTodo from '../components/EditTodo.vue'
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
    },
    {
        name:'EditTodo',
        path:'/edit_todo',
        component:EditTodo
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router
