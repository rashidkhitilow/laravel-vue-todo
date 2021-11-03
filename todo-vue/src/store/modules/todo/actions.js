import axios from "../../../axios"
const retrieveTodos = context => {
  axios()
    .get("/todos")
    .then(response => {
      context.commit("retrieveTodos", response.data);
    })
    .catch(error => {
      console.log(error);
    });
};
const clearTodos = context => {
  context.commit("clearTodos");
};
const addTodo = (context, todo) => {
  axios()
    .post("/todos", {
      title: todo.title,
      completed: false
    })
    .then(response => {
      context.commit("addTodo", response.data);
    })
    .catch(error => {
      console.log(error);
    });
};
const updateTodo = (context, todo) => {
  axios()
    .put("/todos/" + todo.id, {
      title: todo.title,
      completed: todo.completed
    })
    .then(response => {
      context.commit("updateTodo", response.data);
    })
    .catch(error => {
      console.log(error);
    });
};
const deleteTodo = (context, id) => {
  axios()
    .delete("/todos/" + id)
    .then(response => {
      context.commit("deleteTodo", id);
    })
    .catch(error => {
      console.log(error);
    });
};
const checkAll = (context, checked) => {
  axios()
    .put("/todosCheckAll", {
      completed: checked
    })
    .then(response => {
      context.commit("checkAll", checked);
    })
    .catch(error => {
      console.log(error);
    });
};
const updateFilter = (context, filter) => {
  context.commit("updateFilter", filter);
};
const clearCompleted = context => {
  const completed = context.state.todos
    .filter(todo => todo.completed)
    .map(todo => todo.id);

  axios()
    .delete("/todosDeleteCompleted", {
      data: {
        todos: completed
      }
    })
    .then(response => {
      context.commit("clearCompleted");
    })
    .catch(error => {
      console.log(error);
    });
};

export default {
  retrieveTodos,
  clearTodos,
  addTodo,
  updateTodo,
  deleteTodo,
  checkAll,
  updateFilter,
  clearCompleted
};
