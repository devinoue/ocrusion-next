<template>
  <div class="hidden lg:block">
    <ul class="inline-flex items-center">
      <li v-for="(path, index) in paths" :key="path.path + index">
        <nuxt-link
          class="px-4 menu-link"
          :to="path.path"
          :class="activeClass(path.path)"
          >{{ path.name }}</nuxt-link
        >
      </li>

      <li v-if="isMember">
        <button
          class="px-4 menu-link button-menu focus:outline-none focus:shadow-outline"
          href="#"
          to="#"
          @click.prevent="logout"
        >
          ログアウト
        </button>
      </li>

      <li v-else>
        <nuxt-link class="button" to="/auth/register">新規登録</nuxt-link>
      </li>
    </ul>
  </div>
</template>
<script lang="ts">
import { ref, SetupContext, defineComponent } from 'nuxt-composition-api'
type Props = {
  isMember: boolean
}
export default defineComponent({
  name: '',
  props: {
    isMember: {
      type: Boolean,
      required: false,
      default: false,
    },
  },
  setup(props: Props, { root }: SetupContext) {
    const paths = props.isMember
      ? [
          { name: 'ホーム', path: '/' },
          { name: '一覧', path: '/members/dashboard/1' },
          { name: 'アップロード', path: '/members/upload' },
        ]
      : [
          { name: 'ホーム', path: '/' },
          { name: '特徴・機能', path: { path: '/', hash: '#feature' } },
          { name: 'プラン', path: { path: '/', hash: '#plan' } },
          { name: 'ログイン', path: '/auth/login' },
        ]

    const activeClass = (path: string) => {
      return path === root.$route.path ? 'button-menu-fixed' : 'button-menu'
    }

    const logout = async () => {
      await root.$store.dispatch('Auth/logout')

      root.$router.push({ path: '/auth/login' })
    }

    return { paths, activeClass, logout }
  },
})
</script>
<style lang="scss" scoped>
.button-menu-fixed {
  &::after {
    position: absolute;
    bottom: -10px;
    left: 0;
    content: '';
    width: 100%;
    height: 2px;
    background: #053657e8;
    transform: scale(1, 1);
  }
}
.button-menu {
  &::after {
    position: absolute;
    bottom: -10px;
    left: 0;
    content: '';
    width: 100%;
    height: 2px;
    background: #0a3557;
    transform: scale(0, 1);
    transform-origin: right top;
    transition: transform 0.3s;
  }
  &:hover {
    &::after {
      transform-origin: left top;
      transform: scale(1, 1);
    }
  }
}
</style>
