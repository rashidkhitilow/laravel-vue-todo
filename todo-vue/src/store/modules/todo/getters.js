const remaining = state => {
  return state.todos.filter(todo => !todo.completed).length;
};
const anyRemaining = (state, getters) => {
  return getters.remaining != 0;
};
const todosFiltered = state => {
  if (state.filter == "all") {
    return state.todos;
  } else if (state.filter == "active") {
    return state.todos.filter(todo => !todo.completed);
  } else if (state.filter == "completed") {
    return state.todos.filter(todo => todo.completed);
  }
  return state.todos;
};
const showClearCompletedButton = state => {
  return state.todos.filter(todo => todo.completed).length > 0;
};

export default{
    remaining,
    anyRemaining,
    todosFiltered,
    showClearCompletedButton
}