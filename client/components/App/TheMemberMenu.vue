<template>
  <div class="hidden lg:block">
    <ul class="inline-flex items-center">
      <li><a class="px-4 menu-link" href="/">トップ</a></li>
      <li><a class="px-4 menu-link" href="/members/dashboard">一覧</a></li>
      <li><a class="px-4 menu-link" href="/members/upload">アップロード</a></li>
      <li>
        <a class="px-4 menu-link" href="#" @click.prevent="logout">
          ログアウト
        </a>
      </li>
    </ul>
  </div>
</template>
<script lang="ts">
import { ref, SetupContext } from 'nuxt-composition-api'
export default {
  name: '',
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
