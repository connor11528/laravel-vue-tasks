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
        <div class="row text-center" v-if="loading">
            <rotate-square2></rotate-square2>
        </div>

        <ul class="list-group" v-if="!loading">
            <li v-if='list.length === 0'>There are no tasks yet!</li>
            <li class="list-group-item" v-for="(task, index) in list">

                {{ task.body }}

                <button @click="deleteTask(task.id)" class="btn btn-danger btn-xs pull-right">Delete</button>
            </li>
        </ul>
    </div>
</template>

<script>
	import {RotateSquare2} from 'vue-loading-spinner';

	export default {
		components: {
			RotateSquare2
		},
        data() {
            return {
            	loading: true,
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
                axios.get('api/tasks')
                    .then((res) => {
                            this.list = res.data;
                            this.loading = false;
                    })
			        .catch((err) => console.error(err));;
            },
 
            createTask() {
                axios.post('api/tasks', this.task)
                    .then((res) => {
                        this.task.body = '';
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
