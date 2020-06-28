import axios from 'axios'
import {IUserSettings} from '~/types'
import BaseApi from './BaseApi'

export class UserSettings extends BaseApi {
  constructor() {
    super()
  }

  post(data: IUserSettings) {
    return axios.post('/api/user-settings', data)
  }
}
