<template>
  <div
    class="popup_window card shadow-lg d-print-none"
    style="min-width: 650px; max-width: 1000px; position: fixed; top: 100px; left: 50%; margin-left: -325px;z-index: 9999;"
  >
    <div class="card-header bg-primary text-white p-0" style="cursor: move">
      <h5 class="m-0 p-3 w-100">
        Add new product
        <button
          style="float: right"
          @click="() => this.$emit('hideAddModal')"
          type="button"
          class="btn text-white m-0 p-0"
        >
          <h5 class="m-0">×</h5>
        </button>
      </h5>
    </div>
    <div class="card-body" style="max-height: 700px;overflow: auto;">
    <div class="row">
        <div class="col-auto">
        <label>Title*</label>
        <input autocomplete="off"
            type="text"
            class="form-control"
            v-model="title"
            @keyup.enter="addProduct"
            placeholder="Product name..."
        />
        </div>
        <div class="col-auto mb-3">
        <label style="width: 100%;">&nbsp;</label>
        <button type="button" class="btn btn-primary" @click="addProduct">
            Save
        </button>
        </div>
    </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "add",
  props: {
    isAddModalVisible: {
      type: Boolean,
      reqired: true
    }
  },
  data() {
    return {
      title: ""
    };
  },
  methods: {
    addProduct() {
      if (this.title.trim().length == 0) {
        return;
      }
      this.$store.dispatch("addProduct",{
          title: this.title
      })
      this.title = ''
      this.$emit("hideAddModal")
    },
  }
};
</script>
<style></style>
