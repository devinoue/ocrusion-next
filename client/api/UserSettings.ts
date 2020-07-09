import axios from 'axios'
import BaseApi from './BaseApi'
import { IUserSettings } from '~/types'

export class UserSettings extends BaseApi {
  constructor() {
    super()
  }

  post(data: IUserSettings) {
    return axios.post('/api/user-settings', data)
  }
}
