<template>
  <div class="container overflow-auto">
    <!-- <b-pagination
      v-model="currentPage"
      :total-rows="total"
      :per-page="perPage"
      aria-controls="my-table"
    ></b-pagination> -->
    <table class="table table-bordered table-hover table-sm text-center">
      <tbody>
        <tr class="table-secondary text-center">
          <th>ID</th>
          <th>Title</th>
          <th>Date</th>
          <th></th>
        </tr>
        <tr v-for="(item, index) in units" :key="index">
          <td>{{ item.id }}</td>
          <td>{{ item.title }}</td>
          <td>{{ item.created_at }}</td>
          <td>
            <div class="btn-group">
              <button
                type="button"
                class="btn btn-outline-primary btn-sm"
                title="Edit product"
                @click.prevent="showEditModal(item.id, item.title)"
              >
                <b-icon-pencil-square></b-icon-pencil-square>
              </button>
              <button
                type="button"
                class="btn btn-outline-primary btn-sm"
                @click="deleteProduct(item.id)"
                title="Remove product"
              >
                <b-icon-x-square></b-icon-x-square>
              </button>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
    <paginate module="units"></paginate>
  </div>
</template>

<script>
import paginate from "../../config/paginate.vue";
export default {
  components: { paginate },
  data() {
    return {
    };
  },
  created() {
    this.$store.dispatch("getList", 0);
  },
  // watch: {
  //   currentPage(newVal, oldVal) {
  //     this.paginatePage(newVal);
  //   }
  // },
  computed: {
    units() {
      return this.$store.getters.units.data;
    },
    // currentPage: {
    //   get() {
    //     return this.$store.getters.units.current_page;
    //   },
    //   set(value) {
    //     this.$store.dispatch("setCurrentPage", value);
    //   }
    // },
    // perPage: {
    //   get() {
    //     return this.$store.getters.units.per_page;
    //   }
    // },
    // total: {
    //   get() {
    //     return this.$store.getters.units.total;
    //   }
    // }
  },
  // methods: {
  //   paginatePage(pageNumber) {
  //     this.$store.dispatch("getList", pageNumber);
  //   }
  // }
};
</script>

<style></style>
