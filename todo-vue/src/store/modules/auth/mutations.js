const retrieveToken = (state, token) => {
  state.token = token;
};
const destroyToken = state => {
  state.token = null;
};

export default {
  retrieveToken,
  destroyToken
};
