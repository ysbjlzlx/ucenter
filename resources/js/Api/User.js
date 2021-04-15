import axios from "@/Api/RequestClient";

export function profile() {
  return axios.get("/api/user/profile");
}

export function changePassword(data) {
  return axios.post("/api/user/password/change", data);
}
