import { api } from "./axios";
import axios from "axios";

export async function login(loginCredentials) {
    try {
        const res = await axios.post(
            "http://127.0.0.1:8000/api/login",
            loginCredentials,
            {
                headers: {
                    Accept: "application/json",
                    "Content-Type": "application/json",
                    "X-Requested-With": "XMLHttpRequest",
                    Authorization: "Bearer " + localStorage.getItem("token"),
                },
            }
        );
        console.log(res);
        return res;
    } catch (error) {
        console.error(error);
        return error;
    }
}
