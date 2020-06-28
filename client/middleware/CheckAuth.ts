import {Context} from '@nuxt/types'

export default async ({store}: Context) => {
  const user = store.getters['Auth/user']

  if (!user) {
    await store.dispatch('Auth/fetchUser')
  }
}
