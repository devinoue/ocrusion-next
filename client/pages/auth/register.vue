<template>
  <div>
    <input v-model="name" class="shadow-outline" type="text" /><br />
    <input v-model="email" class="shadow-outline" type="text" /><br />
    <input v-model="password" class="shadow-outline" type="text" /><br />

    <input
      v-model="passwordConfirmation"
      class="shadow-outline"
      type="text"
    /><br />
    <button @click.stop="register()">押す</button>
  </div>
</template>
<script lang="ts">
import { ref } from '@vue/composition-api'
import axios from 'axios'
import { RegisterApi } from '~/api/RegisterApi'

export default {
  name: '',
  setup() {
    const name = ref('aaa')
    const email = ref('bb@ko.com')
    const password = ref('hogehoge')
    const passwordConfirmation = ref('hogehoge')

    const register = async () => {
      const data = {
        name: name.value,
        email: email.value,
        password: password.value,
        passwordConfirmation: passwordConfirmation.value,
      }
      const registerApi = new RegisterApi()
      try {
        const res = await registerApi.post(data)
        console.log(res)
      } catch (e) {
        console.log(e.reponse)
      }

      // const res = await axios
      //   .post('http://localhost:8000/api/register', data)
      //   .catch((e) => {
      //     console.log(e)
      //   })
      // console.log(res)
      // Must verify email fist.
      // if (res.data.status) {
      //   console.log('ダメっぽい')
      // } else {
      //   console.log('できた！')
      // }
    }

    return {
      name,
      email,
      password,
      passwordConfirmation,
      register,
    }
  },
}
</script>
<style lang="scss" scoped></style>
