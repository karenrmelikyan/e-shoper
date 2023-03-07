<template>
    <!-- Shop Sidebar Start -->
    <div class="col-lg-3 col-md-12">
        <!-- Price Start -->
        <div class="border-bottom mb-4 pb-4">
            <h5 class="font-weight-semi-bold mb-4">Filter by price</h5>
            <form>
                <div v-for="index in pricesRange" class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                    <input v-model="prices" :value="index" type="checkbox" class="custom-control-input" :id="`price_${index / 100}`">
                    <label class="custom-control-label" :for="`price_${index / 100}`">{{ '$' + index + ' - $' + (index + 100) }}</label>
                    <span class="badge border font-weight-normal">1000</span>
                </div>
            </form>
        </div>
        <!-- Price End -->

        <!-- Categories Start -->
        <div class="mb-5">
            <h5 class="font-weight-semi-bold mb-4">Filter by categories</h5>
            <form>
                <div v-for="category in filterList.categories" class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                    <input v-model="categories" :value="category.id" type="checkbox" class="custom-control-input" :id="`category_${category.id}`">
                    <label class="custom-control-label" :for="`category_${category.id}`">{{ category.title }}</label>
                    <span class="badge border font-weight-normal">1000</span>
                </div>
            </form>
        </div>
        <!-- Categories End -->

        <!-- Color Start -->
        <div class="mb-5">
            <h5 class="font-weight-semi-bold mb-4">Filter by colors</h5>
            <form>
                <div v-for="color in filterList.colors" class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                    <input v-model="colors" :value="color.id" type="checkbox" class="custom-control-input" :id="`color_${color.id}`">
                    <label class="custom-control-label" :for="`color_${color.id}`">{{ color.title }}</label>
                    <span class="badge border font-weight-normal">1000</span>
                </div>
            </form>
        </div>
        <!-- Color End -->

        <!-- Tags Start -->
        <div class="mb-5">
            <h5 class="font-weight-semi-bold mb-4">Filter by tags</h5>
            <form>
                <div v-for="tag in filterList.tags" class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                    <input v-model="tags" :value="tag.id"  type="checkbox" class="custom-control-input" :id="`tag_${tag.id}`">
                    <label class="custom-control-label" :for="`tag_${tag.id}`">{{ tag.title }}</label>
                    <span class="badge border font-weight-normal">1000</span>
                </div>
            </form>
        </div>
        <!-- Tags End -->
        <button @click.prevent="applyFilters" class="btn btn-dark">Filter</button>
    </div>
    <!-- Shop Sidebar End -->
</template>

<script>
export default {
    name: "SidebarFilter",

    data() {
        return {
            pricesRange: [0, 100, 200, 300, 400],
            prices: [],
            categories: [],
            colors: [],
            tags: [],
            filterList: [],
            products: [],

        }
    },

    methods: {

         applyFilters()  {
             this.axios.post(`${this.domain}/api/v1/filters`, {
                 'prices': this.prices,
                 'categories': this.categories,
                 'colors': this.colors,
                 'tags': this.tags,
             }).then(res => {
                 this.products = res.data.data;
                 this.$emit('applied-filter')
             }).catch(err => {
                 console.log(err)
             })
         },

         getFilterList() {
             this.axios.get(`${this.domain}/api/v1/filters`)
                 .then(res => {
                     this.filterList = res.data
                 }).catch(err => {
                     console.log(err)
             })
         }
    },

    mounted() {
        this.getFilterList()
    }
}
</script>
