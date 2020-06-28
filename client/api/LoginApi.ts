import axios, {AxiosInstance} from 'axios'
import {IApi, IUserLoginData, IUserRegisterData} from '../types'
import BaseApi from './BaseApi'

export class LoginApi extends BaseApi implements IApi {
  protected axios: AxiosInstance

  constructor() {
    super()
    this.axios = axios.create({baseURL: BaseApi.baseURL, headers: BaseApi.getHeaders()})
  }

  post(data: IUserLoginData) {
    return this.axios.post('/oauth/token', data)
  }

  fetch() {
    return this.axios.get('/get')
  }

  save(data: unknown) {
    return this.axios.post('/post', data)
  }
}
