import axios from 'axios'

export default () => {
    let headers = {
        'cache-control': 'no-cache'
    };
    let accessToken = localStorage.getItem('access_token');

    if (accessToken && accessToken !== '') {
        headers.Authorization = "Bearer " + accessToken;

    };
    const instance = axios.create({
        baseURL: 'http://127.0.0.1:8000/api',
        headers: headers
    });

    instance.interceptors.response.use((response) => {
        if(response.status === 401) {
          this.$store.dispatch("clearTodos");
          this.$store.dispatch("destroyToken").then(response => {
            this.$router.push({ name: "home" });
          });
        }
        return response;
    }, (error) => {
        if (error.response && error.response.data) {
            localStorage.removeItem('access_token');
            window.location.reload(true);
            return Promise.reject(error.response.data);
        }
        return Promise.reject(error.message);
    });

    return instance;
}