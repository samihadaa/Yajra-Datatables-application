<template>
    <div>
        <router-link to="/"><span class="text-primary"
                style="font-size: 3rem;margin-left: 5rem;">&#x2190;</span></router-link>
    </div>
    <div class="container mt-4">
        <form @submit.prevent="" novalidate>
            <div class="mb-3">
                <label for="Task" class="form-label">Task</label>
                <input v-model.trim="TodoName" type="text" class="form-control" id="Task" aria-describedby="textHelp"
                    placeholder="Add a task...">
                <span v-if="nameError" class="text-danger">{{ nameError }}</span>
            </div>
            <div class="mb-3 form-check">
                <input v-model="accomplished" type="checkbox" class="form-check-input" id="Accomplished">
                <label class="form-check-label" for="Accomplished">Accomplished</label>
            </div>
            <button type="submit" @click="saveTask" class="btn btn-primary">Submit</button>
        </form>
    </div>
</template>

<script>
export default {
    name: 'AddTask',
    data() {
        return {
            TodoName: '',
            accomplished: false,
            nameError: '',
        }
    },
    methods: {
        async saveTask() {
            this.accomplished = this.accomplished ? 1 : 0;
            let formData = new FormData()
            formData.append('name', this.TodoName)
            formData.append('accomplished', this.accomplished)
            let url = 'http://localhost:8000/api/todos/new-todo' // Correct URL
            try {
                let response = await axios.post(url, formData)
                this.$router.push({ path: '/' })
            } catch (error) {
                if (error.response.status === 422) {
                    this.nameError = error.response.data.errors.name[0]
                    console.log('this.nameError', this.nameError)
                }
            }
        }
    },
}
</script>

<style></style>
