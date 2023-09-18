import axios from 'axios';

const api = axios.create({
	baseURL: '/api/',
	withCredentials: true,
	headers: {
		'Accept': 'application/json',
		'Content-Type': 'application/json',
		"Authorization": 'Bearer ' + localStorage.getItem('token'),
	},
});

export { api };
