import Vue from "vue";
import Vuex from "vuex";


import todo from "./modules/todo";
import auth from "./modules/auth";
import unit from "./modules/unit";
import product from "./modules/products";

Vue.use(Vuex);


export const store = new Vuex.Store({
  modules: {
    module1: todo,
    module2 : auth,
    module3 : unit,
    module4 : product,
  }
});
