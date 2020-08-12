export default class BaseApi {
  protected static baseURL: string =
    process.env.NODE_ENV === 'production'
      ? 'http://54.250.102.215:8080'
      : 'http://localhost:8080'

  static getHeaders() {
    // const token = ctx.store.getters['Auth/token'] ?? ''

    return {
      'Content-Type': 'application/json',
      // Authorization: `Bearer ${token}`,
    }
  }
}
