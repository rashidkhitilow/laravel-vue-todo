<template>
  <div>
    <button
      id="load_more_btn"
      v-if="can_load_more"
      type="button"
      @click="loadMore"
      ref="myBtn"
      class="btn btn-sm btn-primary pl-5 pr-5 waves-effect waves-light"
      v-html="btnInner"
    ></button>
  </div>
</template>

<script>
import axios from "../axios";
export default {
  data() {
    return {
      last_loaded_page: 1,
      loading_more: false,
      can_load_more: true,
      data: {},
      btnInner: `<i class="fa fa-arrow-circle-down"></i> <span>Load more...</span>`
    };
  },
  created() {
    window.addEventListener("scroll", this.handleScroll);
  },
  destroyed() {
    window.removeEventListener("scroll", this.handleScroll);
  },
  methods: {
    loadMore() {
      let self = this
      if (this.loading_more) return;
      this.loading_more = true;
      var old_content = this.btnInner;
      this.btnInner = "<h1>Loading...</h1>";

      this.last_loaded_page += 1;
      this.data["page"] = this.last_loaded_page;
console.log(this.data);
      axios()
        .get("/products/filter", {
          data: self.data
        })
        .then(data => {
          self.can_load_more = false;
          data.data.all.items.forEach(function (value, key) {
            console.log(value);
            self.can_load_more = true;
            self.$store.getters.products.push(value)
          })
        })
        .catch(error => {
          console.log(error);
        })
        .then(function() {
          self.loading_more = false;
          self.btnInner = old_content;
        });
    },
    handleScroll(event) {
      if (
        this.can_load_more &&
        !this.loading_more &&
        window.scrollY >= document.body.scrollHeight - window.innerHeight - 1
      ) {
        const elem = this.$refs.myBtn;
        elem.click();
      }
    }
  }
};
</script>
