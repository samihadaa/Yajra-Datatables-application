<template>
    <div>
        <router-link to="/"><span class="text-primary"
                style="font-size: 3rem;margin-left: 5rem;">&#x2190;</span></router-link>
    </div>
    <div class="container mt-4">
        <form @submit.prevent="" novalidate>
            <div class="mb-3">
                <label for="Task" class="form-label">Task</label>
                <input v-model.trim="task.name" type="text" class="form-control" id="Task" aria-describedby="textHelp"
                    placeholder="Add a task...">
                <span v-if="nameError" class="text-danger">{{ nameError }}</span>
            </div>
            <div class="mb-3 form-check">
                <input v-model="task.accomplished" type="checkbox" class="form-check-input" id="Accomplished"
                    :checked="task.accomplished">
                <label class="form-check-label" for="Accomplished">Accomplished</label>
            </div>
            <button type="submit" @click="editTask" class="btn btn-primary">Submit</button>
        </form>
    </div>
</template>

<script>
export default {
    name: 'EditTodo',
    data() {
        return {
            //Task variables
            TodoName: '',
            accomplished: '',
            nameError: '',
            task: {}
        }
    },
    async mounted() {
        await this.getTask()
    },
    methods: {
         /**
         * Update the task by editing name and check/uncheck accomplished
         *
         * @param (String)  this.task.name this.task.accomplished | (int) id
         *
         * @return Redirect
         *
         * @error handle axios error
        */        async editTask() {
            this.task.accomplished = this.task.accomplished ? 1 : 0;
            let formData = new FormData()
            formData.append('name', this.task.name)
            formData.append('accomplished', this.task.accomplished)
            const id = this.$route.query.id
            let url = `http://localhost:8000/api/todos/update/${id}`
                await axios.post(url, formData)
                    .then(response => {
                        this.$router.push({ path: '/' })
                    })
                    .catch(error => {
                        if (error.response.status === 422) {
                            this.nameError = error.response.data.errors.name[0]
                            console.log('error.response.data :', error.response.data.errors.name[0])
                        }
                    });
        },
        /**
         * Get the task list
         *
         * @param int  id
         *
         * @return object $task
         *
         * @error handle axios error
        */
        async getTask() {
            const SELF = this
            const id = this.$route.query.id
            let url = `http://localhost:8000/api/todos/${id}`
            await axios.get(url)
                .then(response => {
                    console.log('response:', response.data.data);
                    SELF.task = response.data.data
                })
                .catch(error => {
                    console.error('Error fetching task:', error.response.data);
                });
        }
    }

}
</script>

<style></style>
