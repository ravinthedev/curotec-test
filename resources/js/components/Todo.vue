<template>

    <div class="container">

        <h1 class="heading">Tasks <span class="grey">({{ list.length }})</span></h1>

        <div class="input-group">

            <input type="text" class="form-control" v-model="todo.body">
            <button class="btn btn-primary" @click="createTodo()"><i class="fa fa-plus"></i> Add</button>
        </div>

        <ul class="todo-list">
            <li v-for="todo in list" @click="changeStatus(todo.id, todo.status)"
                :class="todo.status === 1 ? 'completed' : 'pending'">
                <p>{{todo.text}}</p>
                <button class="btn btn-danger" @click="deleteTodo(todo.id)"><i class="fa fa-times"></i></button>
            </li>
        </ul>

    </div>

</template>

<script>

    export default {
        data: function () {
            return {
                list: [],
                todo: {
                    id: '',
                    body: '',
                    status: ''
                },
                editingTask: {},
                activeItem: 'current'
            }
        },

        mounted() {
            this.loadList();
        },
        methods: {

            loadList() {
                axios.get('/api/todo/list')
                    .then((response) => {
                        this.list = response.data;
                        console.log(response.data)
                    })
                    .catch()

            },
            createTodo() {

                console.log(this.todo);

                axios.post('/api/todo/create', this.todo).then(result => {
                    this.todo.body = '';
                    this.loadList();
                }).catch(err => {
                    console.log(err);
                });


            },
            deleteTodo(id) {
                axios.post('/api/todo/delete/' + id).then(result => {
                    this.loadList();
                }).catch(err => {
                    console.log(err);
                });


            },

            changeStatus(id, status) {

                let newStatus = status === 1 ? 0 : 1;
                axios.post('/api/todo/change/' + id + '/' + newStatus).then(result => {

                    this.loadList();
                }).catch(err => {
                    console.log(err);
                });


            }
        }
    }

</script>

<style>

    .heading {
        padding-top: 40px;
    }

    ul.todo-list {
        list-style: none;
        margin: 0;
        padding: 0;
        width: 100%;
        display: block;

    }

    ul.todo-list li {
        background: #f8f9fa;
        padding: 0;
        margin-bottom: 10px;
        margin-top: 10px;
        position: relative;
        border-radius: 5px;
        font-size: 1.2rem;
    }

    ul.todo-list li button {
        position: absolute;
        right: 5px;
        top: 5px;
    }

    li.completed {
        background: #28a7457d !important;
        color: #fff;
    }

    li.completed p {
        text-decoration: line-through;
    }

    span.grey {
        color: #bfb9b9;
    }

    button.btn.btn-primary {
        border-radius: 0;
    }

    ul.todo-list p {
        padding-left: 10px;
        padding-top: 10px;
        padding-bottom: 10px;
    }
</style>
