<template>
    <div class='row'>
        <h1>My Tasks</h1>
        <h4>New Task</h4>
        <form action="#" @submit.prevent="edit ? updateTask(task.id) : createTask()">
            <div class="input-group">
                <input v-model="task.body" type="text" name="body" class="form-control" autofocus>
                <span class="input-group-btn">
                    <button v-show="!edit" type="submit" class="btn btn-primary">New Task</button>
                    <button v-show="edit" type="submit" class="btn btn-primary">Edit Task</button>
                </span>
            </div>
        </form>
        <h4>All Tasks</h4>
        <ul class="list-group">
            <li class="list-group-item" v-for="task in list">
                {{ task.body }}
                <button @click="showTask(task.id)" class="btn btn-primary btn-xs">Edit</button>
                <button @click="deleteTask(task.id)" class="btn btn-danger btn-xs">Delete</button>
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        data: function() {
            return {
                edit: false,
                list: [],
                task: {
                    id: '',
                    body: ''
                }
            };
        },
        
        mounted: function() {
            this.fetchTaskList();
        },
        
        methods: {
            fetchTaskList: function() {
                var vm = this;
                axios.get('api/tasks').then(function (response) {
                    vm.list = response.data;
                });
            },
 
            createTask: function () {
                axios.post('api/tasks', this.task)
                    .then((res) => {
                        console.log(res);
                        this.task.body = '';
                        this.edit = false;
                        this.fetchTaskList();
                    })
                    .catch((err) => console.error(err));
            },
 
            updateTask: function(id) {
                axios.patch('api/tasks/' + id, this.task);
                this.task.body = '';
                this.edit = false;
                this.fetchTaskList();
            },
 
            showTask: function(id) {
                axios.get('api/tasks/' + id).then(function(response) {
                    this.task.id = response.data.id
                    this.task.body = response.data.body
                })
                this.edit = true
            },
 
            deleteTask: function (id) {
                axios.delete('api/task/' + id)
                this.fetchTaskList()
            },
        }
    }
</script>
</script>
