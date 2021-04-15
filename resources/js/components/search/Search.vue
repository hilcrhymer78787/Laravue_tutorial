<template>
    <div class="searchComponent">
        <form @submit.prevent="taskSearch">
            緊急：<input v-model="search.emergency" type="checkbox"><br>
            内容：<input v-model="search.content" type="text">
            <button>search</button>
        </form>
        <hr>
        <div v-show="isShow" class="pagination">
            <v-pagination v-model="nowPage" :length="maxPages" @input="getNumber"></v-pagination>
        </div>
        <ul>
            <li v-for="(task, index) in tasks" :key="index">
                緊急：<input type="checkbox" v-model="task.emergency" disabled='disabled'><br>
                内容：<span :class="{red:task.emergency}">{{task.content}}</span>
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    data() {
        return {
            isShow: false,
            nowPage: 1,
            maxPages: 0,
            itemsNum: 1,
            maxItems: 5,
            taskDatas: [],
            search: {
                content: "",
                emergency: false,
            },
            tasks: [],
        };
    },
    methods: {
        taskSearch() {
            axios.post("/api/task/search", this.search).then((res) => {
                this.taskDatas = res.data;
                this.getNumber(1);
                this.isShow = true;
            });
        },
        getNumber(page) {
            let maxNum = this.taskDatas.length;
            this.maxPages = Math.ceil(maxNum / this.maxItems);
            this.tasks.splice(0, this.tasks.length);
            for (let i = 0; i < this.maxItems; i++) {
                if (i + this.maxItems * (page - 1) < maxNum - 1) {
                    this.tasks.push(
                        this.taskDatas[i + this.maxItems * (page - 1)]
                    );
                }
            }
        },
    },
    mounted() {},
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
.pagination {
    max-width: 500px;
    margin-bottom: 15px;
    nav ::v-deep .v-pagination {
        &__item {
            color: #000066;
            border: 1px solid #000066;
            &--active {
                color: white;
                background-color: #000066;
            }
        }
        &__navigation {
            border: 1px solid #000066;
            .theme--light.v-icon {
                color: #000066;
            }
            &--disabled {
                opacity: 0.3;
            }
        }
    }
}
</style>