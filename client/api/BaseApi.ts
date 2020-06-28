// import { store } from "nuxt-composition-api";
import {Context} from '@nuxt/types'

export default class BaseApi {
  protected static baseURL: string = process.env.NODE_ENV === 'production' ? 'a' : 'http://localhost:8000';


  static getHeaders() {
    //const token = store.getters['Auth/token'] ?? ''

    return {
      'Content-Type': 'application/json',
      //Authorization: `Bearer ${token}`,
    }
  }
}
