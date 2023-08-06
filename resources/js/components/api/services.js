
import { api } from './axios';

export async function login(loginCredentials) {
	try {
		const res = await api.post('/login', loginCredentials);
        console.log(res);
		return res
	} catch (error) {
		console.error(error);
		return error
	}
}