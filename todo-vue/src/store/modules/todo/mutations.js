const addTodo = (state, todo) => {
  state.todos.push({
    id: todo.id,
    title: todo.title,
    completed: false,
    editing: false
  });
};

const updateTodo = (state, todo) => {
  const index = state.todos.findIndex(item => item.id == todo.id);
  state.todos.splice(index, 1, {
    id: todo.id,
    title: todo.title,
    completed: todo.completed,
    editing: todo.editing
  });
};
const deleteTodo = (state, id) => {
  const index = state.todos.findIndex(item => item.id == id);
  state.todos.splice(index, 1);
};
const checkAll = (state, checked) => {
  state.todos.forEach(todo => (todo.completed = checked));
};
const updateFilter = (state, filter) => {
  state.filter = filter;
};
const clearCompleted = state => {
  state.todos = state.todos.filter(todo => !todo.completed);
};
const retrieveTodos = (state, todos) => {
  state.todos = todos;
};
const clearTodos = state => {
  state.todos = [];
};

export default {
  addTodo,
  updateTodo,
  deleteTodo,
  checkAll,
  updateFilter,
  clearCompleted,
  retrieveTodos,
  clearTodos
};
