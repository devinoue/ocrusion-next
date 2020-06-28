<template>
  <div>
    メンバーページです
    <a class="dropdown-item pl-3" href="#" @click.prevent="logout">
      ロギアウト
    </a>
  </div>
</template>
<script lang="ts">
import { ref } from 'nuxt-composition-api'
import { SetupContext } from '@vue/composition-api'

export default {
  name: 'Member',
  middleware: 'auth',
  setup(_props: {}, { root }: SetupContext) {
    const logout = async () => {
      // Log out the user.
      await root.$store.dispatch('Auth/logout')

      // Redirect to login.
      root.$router.push({ path: '/auth/login' })
    }
    return { logout }
  },
}
</script>
<style lang="scss" scoped></style>
