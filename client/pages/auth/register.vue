<template>
  <div class="pt-48">
    <RegisterForm @onRegisterButtonPushed="onRegisterButtonPushed" />
  </div>
</template>
<script lang="ts">
import { SetupContext } from '@vue/composition-api'
import useLoading from '~/composables/use-loading'
import { RegisterApi } from '~/api/RegisterApi'

export default {
  name: 'Register',
  head: {
    title: '新規登録',
  },
  setup(_props: {}, { root }: SetupContext) {
    const { changeLoaded, changeLoading, changeFailure } = useLoading()
    const onRegisterButtonPushed = async (data: any) => {
      const registerApi = new RegisterApi()
      try {
        changeLoading()
        await registerApi.post(data)
        changeLoaded()
      } catch (e) {
        if (e.message.includes(422)) {
          alert(
            `同じメールアドレスが使われていますので違うメールアドレスを使用してください\n ${e.message}`
          )
        }
        alert(`${e.message}`)
        changeFailure()
        return
      }

      try {
        changeLoading()
        const loginData = {
          grant_type: 'password',
          client_id: process.env.CLIENT_ID,
          client_secret: process.env.CLIENT_SECRET,
          username: data.email,
          password: data.password,
          remember: false,
        }
        const res = await root.$store.dispatch('Auth/fetchUser', loginData)

        root.$store.dispatch('Auth/saveToken', {
          token: res.data.access_token,
          remember: false,
        })
        changeLoaded()
        // Fetch the user.
        await root.$store.dispatch('Auth/fetchUserName')

        root.$router.push('/members/dashboard/1')
      } catch (e) {
        changeFailure()
        alert(`${e.message}`)
      }
    }

    return {
      onRegisterButtonPushed,
    }
  },
}
</script>
<style lang="scss" scoped></style>
