const getList = (state, lunits) => {
    state.lunits = lunits;
  };
const setCurrentPage = (state, data) => {
    state.lunits.current_page = data;
  };

  export default{
    getList,
    setCurrentPage
  }