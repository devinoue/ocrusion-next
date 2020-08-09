import { Context } from '@nuxt/types'

export default ({ store, redirect }: Context) => {
  if (!store.getters['Auth/token']) {
    return redirect('/auth/login')
  }
}
