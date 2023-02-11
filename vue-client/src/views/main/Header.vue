<template>
    <TopBar />
    <NavBar />
</template>

<script>
import TopBar from '../../components/TopBar.vue'
import NavBar from "../../components/NavBar.vue";
export default {
    name: "Header",

    components:{
        TopBar,
        NavBar,
    }
}
</script>

<style scoped>

</style>
