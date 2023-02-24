<template>
    <TopBar />
    <NavBar />
    <SupportChat />
</template>

<script>
import TopBar from '../../components/TopBar.vue'
import NavBar from "../../components/NavBar.vue";
import SupportChat from "../../components/SupportChat.vue";
export default {
    name: "Header",

    components: {
        TopBar,
        NavBar,
        SupportChat,
    }
}
</script>

<style scoped>

</style>
