<template>
    <div class="taskComponent">
        私の名前は<span>{{user.name}}</span><br>
        メールアドレスは<span>{{user.email}}</span>
        <br>
        <br>
        <a href="/logout">ログアウト</a>
    </div>
</template>

<script>
export default {
    data() {
        return {
            user: {},
        };
    },
    methods: {
        getLoginUser() {
            axios.get("/api/loginuser").then((res) => {
                this.user = res.data;
            });
        },
    },
    mounted() {
        this.getLoginUser();
    },
};
</script>
<style lang="scss" scoped>
span {
    color: red;
}
</style>