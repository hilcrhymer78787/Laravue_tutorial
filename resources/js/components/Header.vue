<template>
    <div class="header">
        <div class="header_nav">
            <router-link to="/task">task</router-link>
            <router-link to="/search">search</router-link>
            <router-link to="/user">user</router-link>
        </div>
    </div>
</template>

<style scoped>
.header {
    text-align: center;
    background-color: #000066;
    margin-bottom: 50px;
}
.header_nav {
    padding: 30px;
}
.header_nav a {
    color: white;
    text-decoration: none;
    font-size: 25px;
    margin-right: 25px;
}
.header_nav a:last-child {
    margin-right: 0;
}
.header_nav a.router-link-active {
    color: #f3920b !important;
}
</style>