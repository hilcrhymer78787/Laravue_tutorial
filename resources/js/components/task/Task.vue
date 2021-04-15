<template>
    <div class="taskComponent">
        <form @submit.prevent="taskCreate">
            緊急：<input v-model="newtask.emergency" type="checkbox"><br>
            内容：<input v-model="newtask.content" type="text">
            <button>create</button>
        </form>
        <hr>
        <ul>
            <li v-for="(task, index) in tasks" :key="index">
                緊急：<input @change="taskUpdate(index)" type="checkbox" v-model="task.emergency"><br>
                内容：<span v-if="!task.edit" :class="{red:task.emergency}">{{task.content}}</span>
                <input v-if="task.edit" v-model="task.content" type="text">
                <button v-if="!task.edit" @click="task.edit = true">edit</button>
                <button v-if="task.edit" @click="taskUpdate(index)">update</button>
                <button @click="taskDelete(task.id)">delete</button>
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    data() {
        return {
            newtask: {
                content: "",
                emergency: false,
            },
            tasks: [],
        };
    },
    methods: {
        taskCreate() {
            if (this.newtask != "") {
                axios.post("/api/task/create", this.newtask).then((res) => {
                    this.newtask.emergency = false;
                    this.newtask.content = "";
                    this.taskRead();
                });
            }
        },
        taskRead() {
            axios.get("/api/task/read").then((res) => {
                this.tasks = res.data;
                this.tasks.forEach((task) => {
                    this.$set(task, "edit", false);
                });
            });
        },
        taskUpdate(index) {
            this.tasks[index].edit = false;
            axios.put("/api/task/update", this.tasks[index]).then((res) => {
                this.taskRead();
            });
        },
        taskDelete(id) {
            axios.delete("/api/task/delete/" + id).then((res) => {
                this.taskRead();
            });
        },
    },
    mounted() {
        this.taskRead();
    },
};
</script>
<style lang="scss" scoped>
li {
    list-style: none;
    margin-bottom: 15px;
}
.red {
    color: red;
}
</style>