import axios from "axios";

axios.interceptors.request.use(
  function (config) {
    console.log(config);
    if (window.localStorage.getItem("access_token")) {
      config.headers.Authorization =
        "Bearer " + window.localStorage.getItem("access_token");
    }
    return config;
  },
  function (error) {
    return Promise.reject(error);
  }
);

export default axios;
