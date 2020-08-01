import { Context } from '@nuxt/types'

export default ({ store, redirect }: Context) => {
  console.log(store.getters['Auth/token'])
  if (!store.getters['Auth/token']) {
    return redirect('/auth/login')
  }
}
