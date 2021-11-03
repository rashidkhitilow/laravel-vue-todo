import axios from "../../../axios"
const getList = (context, pageNumber) => {
  axios()
    .get("/lunits/allWithPagination?page=" + pageNumber)
    .then(response => {
      context.commit("getList", response.data.items);
    })
    .catch(error => {
      console.log(error);
    });
};
const setCurrentPage = (context, data) => {
  context.commit("setCurrentPage", data);
};
export default{
    getList,
    setCurrentPage
}