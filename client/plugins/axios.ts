import axios from 'axios'
import { Context } from '@nuxt/types'

export default ({ app, store }: Context) => {
  axios.defaults.headers.common['Access-Control-Allow-Origin'] = '*'
  axios.defaults.baseURL = process.env.apiUrl =
    process.env.NODE_ENV === 'production'
      ? 'http://localhost:8080'
      : 'http://localhost:8080'
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
