<template>
  <div>
    <LoginForm @onLoginButtonPushed="onLoginButtonPushed" />
  </div>
</template>
<script lang="ts">
import { SetupContext } from '@vue/composition-api'

import useLoading from '~/composables/use-loading'

export default {
  name: 'Login',
  setup(_props: {}, { root }: SetupContext) {
    const { changeLoaded, changeLoading, changeFailure } = useLoading()

    const onLoginButtonPushed = async (forms: any) => {
      const data = {
        grant_type: 'password',
        client_id: process.env.CLIENT_ID,
        client_secret: process.env.CLIENT_SECRET,
        username: forms.email,
        password: forms.password,
        remember: forms.remember,
      }
      try {
        changeLoading()
        const res = await root.$store.dispatch('Auth/fetchUser', data)

        root.$store.dispatch('Auth/saveToken', {
          token: res.data.access_token,
          remember: forms.remember,
        })
        changeLoaded()

        root.$router.push('/members/dashboard')
      } catch (e) {
        changeFailure()
        console.log(e)
      }
    }

    return {
      onLoginButtonPushed,
    }
  },
}
</script>
<style lang="scss" scoped></style>
