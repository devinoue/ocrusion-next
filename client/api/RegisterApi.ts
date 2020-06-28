import axios, {AxiosInstance} from 'axios'
import {IApi, IUserRegisterData} from '../types'
import BaseApi from './BaseApi'

export class RegisterApi extends BaseApi implements IApi {
  protected axios: AxiosInstance

  constructor() {
    super()
    this.axios = axios.create({baseURL: BaseApi.baseURL, headers: BaseApi.getHeaders()})
  }

  post(data: IUserRegisterData) {

    data['password_confirmation'] = data.passwordConfirmation
    return this.axios.post('/api/register', data)
  }

  fetch() {
    return this.axios.get('/get')
  }

  save(data: unknown) {
    return this.axios.post('/post', data)
  }
}
