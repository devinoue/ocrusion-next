import axios from 'axios'
import {Context} from '@nuxt/types'

export default ({app, store, redirect}: Context) => {
  axios.defaults.baseURL = process.env.apiUrl = 'http://localhost:8000'
  if (process.server) {
    return
  }
  axios.interceptors.request.use((request) => {
    request.baseURL = process.env.apiUrl

    const token = store.getters['Auth/token']

    if (token) {
      request.headers.common.Authorization = `Bearer ${token}`
    }
    return request
  })

}
