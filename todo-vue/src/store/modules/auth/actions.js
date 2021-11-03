import axios from "../../../axios"
const retrieveName = context => {
  return new Promise((resolve, reject) => {
    axios()
      .get("/profile")
      .then(response => {
        resolve(response);
      })
      .catch(error => {
        reject(error);
      });
  });
};
const register = (context, data) => {
  return new Promise((resolve, reject) => {
    axios()
      .post("/register", {
        name: data.name,
        email: data.email,
        password: data.password
      })
      .then(response => {
        resolve(response);
      })
      .catch(error => {
        reject(error);
      });
  });
};
const destroyToken = context => {
  if (context.getters.loggedIn) {
    return new Promise((resolve, reject) => {
      axios()
        .post("/logout")
        .then(response => {
          localStorage.removeItem("access_token");
          context.commit("destroyToken");
          resolve(response);
          // console.log(response);
          // context.commit('addTodo', response.data)
        })
        .catch(error => {
          localStorage.removeItem("access_token");
          context.commit("destroyToken");
          reject(error);
        });
    });
  }
};
const retrieveToken = (context, credentials) => {
  return new Promise((resolve, reject) => {
    axios()
      .post("/login", {
        email: credentials.username,
        password: credentials.password
      })
      .then(response => {
        const token = response.data.access_token;

        localStorage.setItem("access_token", token);
        context.commit("retrieveToken", token);
        resolve(response);
        // console.log(response);
        // context.commit('addTodo', response.data)
      })
      .catch(error => {
        console.log(error);
        reject(error);
      });
  });
};

export default {
  retrieveName,
  register,
  destroyToken,
  retrieveToken
};
