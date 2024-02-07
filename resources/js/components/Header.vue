<template>
   <nav class="navbar navbar-expand-lg navbar-light bg-light mb-5">
  <div class="container-fluid">
    <router-link class="navbar-brand" to="/">Home</router-link>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <router-link class="nav-link" to="/add_todo">Add Task</router-link>
        </li>

      </ul>
    </div>
  </div>
</nav>
  </template>

  <script>
  export default {
    name: 'Header',
    data(){
        return{
            name: '',
            accomplished: false,
            errors: [],
        }
    },
    methods:{

    },
  }
  </script>

  <style>

  </style>
