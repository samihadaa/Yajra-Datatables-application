<template>
    <div class="container">
        <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Task</th>
      <th scope="col">Task Date</th>
      <th scope="col">Accomplished</th>
    </tr>
  </thead>
  <tbody v-for="todo in todos" :key="todo.name">
    <tr>
      <th scope="row">1</th>
      <td>{{ todo.name }}</td>
      <td>{{ todo.created_at }}</td>
      <td>{{ todo.accomplished == 0 ? false : true }}</td>
    </tr>
  </tbody>
</table>
    </div>
</template>

<script>
import axios from 'axios'
export default {
  name: 'TodoList',
  data(){
    return{
        todos: [],
    }
  },
  async mounted(){
    await this.getTasks()
  },
  methods:{
    async getTasks(){
       const SELF = this
        let url = 'http://localhost:8000/api/todos'
        await axios.get(url).then( response=>{
            SELF.todos = response.data.data
        }).catch(error =>{
            console.log(error)
        })
    }
  }
}
</script>

<style>

</style>
