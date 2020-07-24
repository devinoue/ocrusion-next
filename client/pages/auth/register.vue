<template>
  <div>
    <RegisterForm @onRegisterButtonPushed="onRegisterButtonPushed" />
  </div>
</template>
<script lang="ts">
import { ref, SetupContext } from '@vue/composition-api'
import useLoading from '~/composables/use-loading'
import { RegisterApi } from '~/api/RegisterApi'

export default {
  name: 'Register',
  setup(_props: {}, { root }: SetupContext) {
    const { changeLoaded, changeLoading, changeFailure } = useLoading()
    const onRegisterButtonPushed = async (param: any) => {
      const registerApi = new RegisterApi()
      try {
        changeLoading()
        const res = await registerApi.post(param)
        console.log(res)
        changeLoaded()
        root.$router.push('/members/dashboard')
      } catch (e) {
        if (e.message.includes(422)) {
          alert(
            '同じメールアドレスが使われていますので違うメールアドレスを使用してください'
          )
        }
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
