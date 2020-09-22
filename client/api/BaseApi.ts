export default class BaseApi {
  protected static baseURL: string =
    process.env.NODE_ENV === 'production'
      ? 'https://www.jisui-ocr.net/server'
      : 'http://localhost/server'

  static getHeaders() {
    // const token = ctx.store.getters['Auth/token'] ?? ''

    return {
      'Content-Type': 'application/json',
      // Authorization: `Bearer ${token}`,
    }
  }
}
