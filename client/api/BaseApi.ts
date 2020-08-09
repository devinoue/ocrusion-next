import { useContext } from 'nuxt-composition-api'
// import { Context } from '@nuxt/types'

export default class BaseApi {
  protected static baseURL: string =
    process.env.NODE_ENV === 'production'
      ? 'php :8080/'
      : 'http://localhost:8080'

  static getHeaders() {
    // const token = ctx.store.getters['Auth/token'] ?? ''

    return {
      'Content-Type': 'application/json',
      // Authorization: `Bearer ${token}`,
    }
  }
}
