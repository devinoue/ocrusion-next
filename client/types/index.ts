/* eslint-disable camelcase */
import { AxiosPromise } from 'axios'

export interface RootState {
  user: string | null | any
  token: string | null | any
}

export interface IApi {
  fetch(): AxiosPromise

  save(data: unknown): void
}
export interface IUserSettings {
  name: string
}

export interface IUserLoginData {
  grant_type: string
  client_id: string
  client_secret: string
  username: string
  password: string
  remember: boolean
}

export interface IUserRegisterData {
  name: string
  email: string
  password: string
  passwordConfirmation: string
  password_confirmation?: string
}

export interface ILoadingState {
  isLoading: boolean
  isLoaded: boolean
  apiError: string
  data: null | unknown
}

export const RequestState = {
  UNINITIALIZED: 'UNINITIALIZED',
  LOADING: 'LOADING',
  LOADED: 'LOADED',
  COMPLETE: 'COMPLETE',
  FAILURE: 'FAILURE',
}
