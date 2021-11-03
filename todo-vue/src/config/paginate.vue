<template>
  <b-pagination
    v-model="currentPage"
    :total-rows="total"
    :per-page="perPage"
    aria-controls="my-table"
  ></b-pagination>
</template>
<script>
export default {
  props: {
    module: {
      type: String,
      required: true
    }
  },
  watch:{
      currentPage(newVal, oldVal){
          this.paginatePage(newVal)
      }
  },
  computed: {
    currentPage: {
      get() {
        return this.$store.getters[this.module].current_page;
      },
      set(value){
          this.$store.dispatch('setCurrentPage', value)
      }
    },
    perPage: {
      get() {
        return this.$store.getters[this.module].per_page;
      }
    },
    total: {
      get() {
        return this.$store.getters[this.module].total;
      }
    }
  },
  methods: {
      paginatePage(pageNumber){
          this.$store.dispatch('getList',pageNumber)
      }
  },
};
</script>

<style lang=""></style>
