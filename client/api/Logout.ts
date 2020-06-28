import axios, {AxiosInstance} from 'axios'
import {IApi, IUserLoginData, IUserRegisterData} from '../types'
import BaseApi from './BaseApi'

export class LogoutApi extends BaseApi implements IApi {

  constructor() {
    super()
  }

  post() {
    return axios.post('/logout')
  }

  fetch() {
    return axios.get('/get')
  }

  save(data: unknown) {
    return axios.post('/post', data)
  }
}
