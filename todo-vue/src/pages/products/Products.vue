<template>
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h1 class="card-title">
              Products
            </h1>
            <button
              type="button"
              class="btn btn-primary float-end"
              @click.prevent="showAddModal"
            >
              <b-icon-plus-circle></b-icon-plus-circle> Add product
            </button>
          </div>
          <div class="card-body">
            <form class="m-0">
              <div class="row">
                <div class="col-12">
                  <table
                    class="table table-bordered table-hover table-sm text-center"
                  >
                    <tbody>
                      <tr class="table-secondary text-center">
                        <th>ID</th>
                        <th>Title</th>
                        <th>Date</th>
                        <th>Requested by</th>
                        <th></th>
                      </tr>
                      <tr v-for="(item, index) in items" :key="index">
                        <td>{{ item.id }}</td>
                        <td>{{ item.title }}</td>
                        <td>{{ item.created_at }}</td>
                        <td>{{ item.user }}</td>
                        <td>
                          <div class="btn-group">
                            <button
                              type="button"
                              class="btn btn-outline-primary btn-sm"
                              title="Edit product"
                              @click.prevent="
                                showEditModal(item.id, item.title)
                              "
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
                  <load></load>
                </div>
              </div>
            </form>
          </div>
          <add v-on:hideAddModal="hideAddModal" v-if="isAddModalVisible"></add>
          <edit
            v-if="isEditModalVisible"
            :editTitle="editTitle"
            :productId="productId"
            v-on:hideEditModal="hideEditModal"
          ></edit>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import Load from '../../config/load.vue';
import Add from "./Add.vue";
import Edit from "./Edit.vue";
export default {
  components: {
    Add,
    Edit,
    Load
  },
  data() {
    return {
      isAddModalVisible: false,
      isEditModalVisible: false,
      editTitle: "",
      productId: ""
    };
  },
  created() {
    this.$store.dispatch("retrieveProducts");
  },
  computed: {
    items() {
      return this.$store.getters.products;
    }
  },
  methods: {
    showAddModal() {
      this.isAddModalVisible = true;
    },
    hideAddModal() {
      this.isAddModalVisible = false;
    },
    showEditModal(id, value) {
      this.isEditModalVisible = true;
      this.productId = id;
      this.editTitle = value;
    },
    hideEditModal() {
      this.isEditModalVisible = false;
    },
    deleteProduct(id) {
      this.$bvModal
        .msgBoxConfirm("Are you sure?")
        .then(value => {
          if (value * 1 === 1) this.$store.dispatch("deleteProduct", id);
        })
        .catch(err => {
          // An error occurred
        });
    }
  }
};
</script>

<style></style>
