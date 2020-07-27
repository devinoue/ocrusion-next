<template>
  <div>
    <RegisterForm @onRegisterButtonPushed="onRegisterButtonPushed" />
  </div>
</template>
<script lang="ts">
import { SetupContext } from '@vue/composition-api'
import axios from 'axios'
import useLoading from '~/composables/use-loading'
import { RegisterApi } from '~/api/RegisterApi'

export default {
  name: 'Register',
  setup(_props: {}, { root }: SetupContext) {
    const { changeLoaded, changeLoading, changeFailure } = useLoading()
    const onRegisterButtonPushed = async (data: any) => {
      const registerApi = new RegisterApi()
      try {
        changeLoading()
        const res = await registerApi.post(data)
        console.log(res)
        changeLoaded()
        root.$router.push({
          path: '/auth/login',
          query: { message: 'thanks' },
        })
      } catch (e) {
        if (e.message.includes(422)) {
          alert(
            `同じメールアドレスが使われていますので違うメールアドレスを使用してください\n ${e.message}`
          )
        }
        console.log(e)
        console.log(e.message)
        console.log(e.reponse)
        changeFailure()
      }
    }

    return {
      onRegisterButtonPushed,
    }
  },
}
</script>
<style lang="scss" scoped></style>
