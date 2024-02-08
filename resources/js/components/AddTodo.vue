<template>
    <div class="container mt-4">
        <form @submit.prevent="" novalidate>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Task</label>
                <input v-model="TodoName" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Add a task...">
                <span v-if="nameError" class="text-danger">{{ nameError }}</span>
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
            nameError: '',
        }
    },
    methods:{
        async saveTask() {
            let formData = new FormData()
            console.log(' this.accomplished :', this.accomplished)
            this.accomplished = this.accomplished ? 1 : 0;
            formData.append('name', this.TodoName.trim())
            formData.append('accomplished', this.accomplished)
            let url = 'http://localhost:8000/api/todos/new-todo' // Correct URL
            try {
                let response = await axios.post(url, formData)
                console.log('response:', response)
            } catch (error) {
                if (error.response.status === 422) {
                    this.nameError = error.response.data.errors.name[0]
                    console.log('this.errors :', this.nameError)
                }
            }
        }
    },
}
</script>

<style>

</style>
