import axios from "@/Api/RequestClient";

export function login(data) {
  return axios.post("/api/auth/login", data);
}

export function register(data) {
  return axios.post("/api/auth/register", data);
}

export function logout(data) {
  return axios.post("/api/auth/logout", data);
}
