import axios from 'axios'

export default class UserAuthApi {
  fetch() {
    return axios.get('')
  }

  auth(email: string, password: string) {
    const data = { email, password }
    return axios.post('http://localhost:8000/api/login', data)
  }
}
