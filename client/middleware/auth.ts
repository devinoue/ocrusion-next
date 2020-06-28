import {Context} from '@nuxt/types'

export default ({store, redirect}: Context) => {
  if (!store.getters['Auth/check']) {
    return redirect('/auth/login')
  }
}
