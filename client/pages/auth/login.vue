<template>
  <div>
    <div v-if="isRegistered" class="simple-message text-center">
      <h1 class="title">ご登録ありかどうございました。</h1>
      <p>登録が完了いたしましたので、 こちらからログインをお願いします。</p>
    </div>
    <LoginForm @onLoginButtonPushed="onLoginButtonPushed" />
  </div>
</template>
<script lang="ts">
import { SetupContext, ref } from '@vue/composition-api'

import { LoginApi } from '../../api/LoginApi'
import useLoading from '~/composables/use-loading'

export default {
  name: 'Login',
  setup(_props: {}, { root }: SetupContext) {
    const { changeLoaded, changeLoading, changeFailure } = useLoading()
    console.log(root.$route)
    const isRegistered = ref(!!root.$route.query?.message)

    const onLoginButtonPushed = async (forms: any) => {
      // const f = await new LoginApi().post()
      // console.log(f)
      // return
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
        console.log(res)
        root.$store.dispatch('Auth/saveToken', {
          token: res.data.access_token,
          remember: forms.remember,
        })

        changeLoaded()

        // Fetch the user.
        await root.$store.dispatch('Auth/fetchUserName')
        console.log(root.$store.getters['Auth/user'].id)
        root.$router.push('/members/dashboard/1')
      } catch (e) {
        changeFailure()
        console.log(e)
        console.log(e.response)
      }
    }

    return {
      isRegistered,
      onLoginButtonPushed,
    }
  },
}
</script>
<style lang="scss" scoped>
.simple-message {
  text-align: center;
}
</style>
