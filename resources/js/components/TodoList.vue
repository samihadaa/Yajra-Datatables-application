<template>
    <div class="container">
        <div>
            <table id="tasks-table" class="table table-bordered">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Completed</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</template>

<script>
import axios from 'axios'
import $ from 'jquery'
import DataTable from 'datatables.net-dt';
export default {
    name: 'TodoList',
    data() {
        return {
        }
    },
    async mounted() {
        const SELF = this;
        $(document).ready(function () {
            $.noConflict();
            $('#tasks-table').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": "http://localhost:8000/api/todos",
                "columns": [
                    { "data": "name" },
                    {
                        "data": "accomplished",
                        render: function (data, type, row) {
                            return data == 1 ? true : false;
                        }
                    },
                    {
                        "data": "created_at",
                        render: function (data, type, row) {
                            return data = data.split('T')[0];
                        }
                    },
                    {
                        // Custom column for actions
                        render: function (data, type, row) {
                            return `
                <button class="btn btn-primary editData" data-id="${row.id}">Edit</button>
                <button class="btn btn-danger deleteData" data-id="${row.id}">Delete</button>
              `;
                        },
                    },
                ]
            })
        })

        $(document).on('click', '.editData', function (event) {
            event.stopPropagation();
            const id = $(this).data('id');
            SELF.$router.push({ path: '/edit_todo', query: { id: id } })
        });
        $(document).on('click', '.deleteData', async function (event) {
            event.stopPropagation();
            const id = $(this).data('id');
            // Make an HTTP DELETE request to delete the task
            await axios.post(`http://localhost:8000/api/todos/delete/${id}`)
                .then(response => {
                    console.log('Task deleted successfully:', response.data);
                    $('#tasks-table').DataTable().ajax.reload();
                })
                .catch(error => {
                    console.error('Error deleting task:', error.response.data);
                });
        });
    },
    methods: {

    }
}
</script>

<style></style>
