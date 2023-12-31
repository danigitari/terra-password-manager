import { api } from "./axios";
import axios from "axios";

export async function login(loginCredentials) {
    try {
        const res = await axios.post(
            "/api/login",
            loginCredentials,
            {
                headers: {
                    Accept: "application/json",
                    "Content-Type": "application/json",
                    "X-Requested-With": "XMLHttpRequest",
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

export async function getUsers() { 
    try {
        const res = await api.get('/getUsers');
        return res.data;
    }
    catch(error) {
        console.error(error);
        return error;
    }
}
export async function getLogs() { 
    try {
        const res = await api.get('/getLogs');
        return res.data.users;
    }
    catch(error) {
        console.error(error);
        return error;
    }
}
export async function getRoles() { 
    try {
        const res = await api.get('/getRoles');
        return res.data;
    }
    catch(error) {
        console.error(error);
        return error;
    }
}
export async function getCredentials() { 
    try {
        const res = await api.get('/getCredentials');
        return res.data;
    }
    catch(error) {
        console.error(error);
        return error;
    }
}