<template>
    <div class="container">
        <div>
            <table id="tasks-table" class="border border-black">
                <thead class="border border-black">
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
        $('#tasks-table').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": "http://localhost:8000/api/todos",
            "columns": [
                { "data": "name" },
                {
                    "data": "accomplished",
                    render: function (data, type, row) {
                        return data == 1 ? 'true' : 'false'; // Convert boolean to string for display
                    }
                },
                {
                    "data": "created_at",
                    render: function (data, type, row) {
                        return data.split('T')[0];
                    }
                },
                {
                    // Adding 2 buttons on the action column to edit and delete
                    render: function (data, type, row) {
                        return `
                    <button class="btn btn-primary editData" data-id="${row.id}">Edit</button>
                    <button class="btn btn-danger deleteData" data-id="${row.id}">Delete</button>
                `;
                    },
                },
            ],
            //This will add a filter to the table by accomplished
            initComplete: function () {
                var table = this.api();
                table.columns().every(function () {
                    var column = this;
                    if (column.index() == 1) { // Check if it's the 'created_at' column
                        var header = $(column.header());
                        header.empty().append('Completed'); // Add column name as label
                        var select = $('<select><option value="">All</option></select>')
                            .appendTo(header)
                            .on('change', function () {
                                var val = $.fn.dataTable.util.escapeRegex(
                                    $(this).val()
                                );
                                column.search(val ? '^' + val + '$' : '', true, false).draw();
                            });
                        column.data().unique().sort().each(function (d, j) {
                            select.append('<option value="' + d + '">' + d + '</option>')
                        });
                    }
                });
            },
            // ADD color to the rows depending on the status of accomplished
            "rowCallback": function (row, data) {
                // Add background color based on the value of the "accomplished" field
                if (data.accomplished == 0) {
                    $(row).addClass('bg-white');
                } else {
                    $(row).addClass('bg-success-subtle');
                }
            }
        });
        //Handling click event on edit button
        $(document).on('click', '.editData', function (event) {
            event.stopPropagation();
            const id = $(this).data('id');
            SELF.$router.push({ path: '/edit_todo', query: { id: id } })
        });
        //Handling click event on delete button
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
}
</script>

<style></style>
