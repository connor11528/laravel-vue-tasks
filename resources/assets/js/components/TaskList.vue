<template>
    <div class='row'>
        <h1>My Tasks</h1>
        <h4>New Task</h4>
        <form action="#" @submit.prevent="createTask()">
            <div class="input-group">
                <input v-model="task.body" type="text" name="body" class="form-control" autofocus>
                <span class="input-group-btn">
                    <button type="submit" class="btn btn-primary">New Task</button>
                </span>
            </div>
        </form>
        <h4>All Tasks</h4>
        <ul class="list-group">
            <li v-if='list.length === 0'>There are no tasks yet!</li>
            <li class="list-group-item" v-for="(task, index) in list">

                {{ task.body }}

                <button @click="deleteTask(task.id)" class="btn btn-danger btn-xs pull-right">Delete</button>
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                list: [],
                task: {
                    id: '',
                    body: ''
                }
            };
        },
        
        created() {
            this.fetchTaskList();
        },
        
        methods: {
            fetchTaskList() {
                axios.get('api/tasks').then((res) => {
                    this.list = res.data;
                });
            },
 
            createTask() {
                axios.post('api/tasks', this.task)
                    .then((res) => {
                        this.task.body = '';
                        this.edit = false;
                        this.fetchTaskList();

                    })
                    .catch((err) => console.error(err));
            },
 
            deleteTask(id) {
                axios.delete('api/tasks/' + id)
                    .then((res) => {
                        this.fetchTaskList()
                    })
                    .catch((err) => console.error(err));
            },
        }
    }
</script>
</script>
