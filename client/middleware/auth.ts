import { Context } from '@nuxt/types'

export default ({ store, redirect }: Context) => {
  console.log(store.getters['Auth/user'])
  if (!store.getters['Auth/check']) {
    return redirect('/auth/login')
  }
}
