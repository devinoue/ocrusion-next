import axios from 'axios'
import { IApi, IUserLoginData } from '../types'
import BaseApi from './BaseApi'
export class LoginApi extends BaseApi implements IApi {
  protected axios: any
  protected ctx: any
  constructor() {
    super()

    this.axios = axios
    // this.axios = axios.create({
    //   baseURL: BaseApi.baseURL,
    //   headers: BaseApi.getHeaders(),
    // })
  }

  post(data: IUserLoginData) {
    return this.axios.post('/oauth/token', data)
  }

  fetch() {
    return this.axios.get('/get')
  }

  fetchUserName() {
    return this.axios.get('/api/user')
  }

  save(data: unknown) {
    return this.axios.post('/post', data)
  }
}
