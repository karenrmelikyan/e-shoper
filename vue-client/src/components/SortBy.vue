<template>
    <div class="dropdown ml-4">
        <button class="btn border dropdown-toggle" type="button" id="triggerId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Sort by {{ by }}
        </button>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="triggerId">
            <a @click.prevent="sortByName" class="dropdown-item" href="#">Name</a>
            <a @click.prevent="sortByPrice" class="dropdown-item" href="#">Price</a>
        </div>
    </div>
</template>

<script>
export default {
    name: "SortBy",

    data() {
        return {
            by: null,
        }
    },

    methods: {

        sortByName() {
            this.by = 'Name'

            // Sort the array by name (in ascending order)
            this.$parent.products.sort((a, b) => {
                if (a.title < b.title) return -1;
                if (a.title > b.title) return 1;
                return 0;
            });
        },

        sortByPrice() {
            this.by = 'Price'

            // Sort the array by price (in ascending order)
            this.$parent.products.sort((a, b) => a.price - b.price);
        },

    },

}
</script>

<style scoped>

</style>
