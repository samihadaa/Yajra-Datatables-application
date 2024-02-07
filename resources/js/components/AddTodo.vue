<template>
    <div class="container mt-4">
        <form @submit.prevent="" novalidate>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Task</label>
            <input v-model="TodoName" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Add a task...">
        </div>
        <div class="mb-3 form-check">
            <input v-model="accomplished" type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Accomplished</label>
        </div>
        <button type="submit" @click="saveTask" class="btn btn-primary">Submit</button>
        </form>
</div>
</template>

<script>
export default {
    name: 'AddTask',
    data(){
        return{
            TodoName: '',
            accomplished: false,
            errors: [],
        }
    },
    methods:{
        saveTask(){
            console.log('TodoName :', this.TodoName.trim())
            console.log('accomplished :', this.accomplished)
        }
    },
}
</script>

<style>

</style>
