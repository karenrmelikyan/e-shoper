<template>
    <form>
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Search by name"
                   v-model="searchingTitle"
                   @keydown.enter.prevent="getProductsByName"
            >
            <div class="input-group-append">
                <span class="input-group-text bg-transparent text-primary">
                    <i class="fa fa-search"></i>
                </span>
            </div>
        </div>
    </form>
</template>

<script>
export default {
    name: "SearchByName",

    data() {
        return {
            searchingTitle: '',
        }
    },

    methods: {
        getProductsByName() {
            this.axios.get(`${this.domain}/api/v1/products/title/${this.searchingTitle}`)
                .then(res => {
                   this.$parent.products = res.data.data
                }).catch(err => {
                    console.log(err.message)
            })
        }
    },
}
</script>

