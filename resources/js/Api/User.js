import axios from "@/Api/RequestClient";

export function profile() {
  return axios.get("/api/user/profile");
}
