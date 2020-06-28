<template>
  <div>
    メール <input v-model="email" class="shadow" type="text" />
    <br />
    <input v-model="password" type="text" class="shadow" />
    <button type="text" class="shadow" @click="login()">押す</button>

    <input type="checkbox" v-model="remember" name="remember" />記憶する
  </div>
</template>
<script lang="ts">
import { ref, SetupContext } from '@vue/composition-api'

export default {
  name: 'Login',
  setup(_props: {}, { root }: SetupContext) {
    const email = ref<string>('bb8@ko.com')
    const password = ref('hogehoge')

    const user = ref({})
    const remember = ref(false)

    const login = async () => {
      const data = {
        grant_type: 'password',
        client_id: process.env.CLIENT_ID,
        client_secret: process.env.CLIENT_SECRET,
        username: email.value,
        password: password.value,
        remember: remember.value,
      }
      try {
        const res = await root.$store.dispatch('Auth/fetchUser', data)
        // user.value = root.$store.getters['Auth/name'] as ReturnType<
        //   typeof getters.name
        // >
        root.$store.dispatch('Auth/saveToken', {
          token: res.data.access_token,
          remember: remember.value,
        })

        // Redirect home.
        root.$router.push({ name: 'member' })
      } catch (e) {
        console.log(e)
      }
    }
    return {
      email,
      password,
      user,
      login,
      remember,
    }
  },
}
</script>
<style lang="scss" scoped></style>
