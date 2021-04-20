import axios from "@/Api/RequestClient";

export function profile() {
  return axios.get("/api/account/profile");
}

export function changePassword(data) {
  return axios.post("/api/account/password/change", data);
}

export function changeAvatar(data) {
  return axios.post("/api/account/avatar/change", data);
}

export function destroy(data) {
  return axios.post("/api/account/destroy", data);
}
