import axios from "../../../axios"
const retrieveProducts = context => {
  axios()
    .get("/products")
    .then(response => {
      context.commit("retrieveProducts", response.data.products.items);
    })
    .catch(error => {
      console.log(error);
    });
};
const addProduct = (context, product) => {
  axios()
    .post("/products/new", {
      title: product.title
    })
    .then(response => {
      context.dispatch("retrieveProducts")
    })
    .catch(error => {
      console.log(error);
    });
};
const editProduct = (context, product) => {
  axios()
    .post("/products/save/" + product.id, {
      title: product.title
    })
    .then(response => {
      context.dispatch("retrieveProducts")
    })
    .catch(error => {
      console.log(error);
    });
};
const deleteProduct = (context, id) => {
  axios()
    .delete("/products/remove/" + id)
    .then(response => {
      context.dispatch("retrieveProducts")
    })
    .catch(error => {
      console.log(error);
    });
};
export default {
  retrieveProducts,
  addProduct,
  editProduct,
  deleteProduct
};
