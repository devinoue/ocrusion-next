<template>
  <div class="">
    <ul
      class="list-reset lg:flex justify-end flex-1 items-center"
      :class="topPageClass"
    >
      <li v-for="(path, index) in paths" :key="path.path + index">
        <nuxt-link
          class="inline-block py-2 px-4 menu-link truncate-pos"
          :to="path.path"
          :class="activeClass(path.path)"
          >{{ path.name }}</nuxt-link
        >
      </li>

      <li v-if="isMember">
        <a
          class="inline-block py-2 px-4 menu-link truncate-pos button-menu bg-bar-normal"
          @click="logout"
        >
          ログアウト
        </a>
      </li>

      <li v-else>
        <nuxt-link
          class="inline-block mt-4 top-page-register-btn truncate-pos"
          to="/auth/register"
          >新規登録</nuxt-link
        >
      </li>
    </ul>
  </div>
</template>
<script lang="ts">
import { SetupContext, defineComponent, computed } from 'nuxt-composition-api'
type Props = {
  isMember: boolean
  isOverScrollLimit: boolean
}
export default defineComponent({
  name: '',
  props: {
    isMember: {
      type: Boolean,
      required: false,
      default: false,
    },
    isOverScrollLimit: {
      type: Boolean,
      required: false,
      defalut: true,
    },
  },
  setup(props: Props, { root }: SetupContext) {
    const paths = props.isMember
      ? [
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
      const classArray =
        path === root.$route.path ? ['button-menu-fixed'] : ['button-menu']
      return root.$route.path === '/' && !props.isOverScrollLimit
        ? [...classArray, 'bg-bar-white']
        : [...classArray, 'bg-bar-normal']
    }
    const topPageClass = computed(() => {
      return root.$route.path === '/' && !props.isOverScrollLimit
        ? ['text-white']
        : null
    })
    const underbarClass = computed(() => {
      return root.$route.path === '/' && !props.isOverScrollLimit
        ? ['bg-white']
        : null
    })

    const logout = async () => {
      await root.$store.dispatch('Auth/logout')
      root.$router.push({ path: '/auth/login' })
    }

    return { paths, topPageClass, activeClass, underbarClass, logout }
  },
})
</script>
<style lang="scss" scoped>
.bg-bar-normal {
  &::after {
    background: #053657e8;
  }
}
li {
  margin-bottom: 5px;
}
.truncate-pos {
  text-overflow: ellipsis;
  white-space: nowrap;
}
.bg-bar-white {
  &::after {
    background: #fff;
  }
}
.button-menu-fixed {
  &::after {
    position: absolute;
    bottom: -10px;
    left: 0;
    content: '';
    width: 100%;
    height: 2px;
    // background: #053657e8;
    transform: scale(1, 1);
  }
}
.button-menu {
  cursor: pointer;
  &::after {
    position: absolute;
    bottom: -10px;
    left: 0;
    content: '';
    width: 100%;
    height: 2px;
    // background: #0a3557;
    transform: scale(0, 1);
    transform-origin: right top;
    transition: transform 1.7s;
  }
  &:hover {
    &::after {
      transform-origin: left top;
      transform: scale(1, 1);
      transition: transform 0.3s;
    }
  }
}

.top-page-register-btn {
  border-width: 0;
  border-style: solid;
  border-color: #e2e8f0;
  margin-left: 15px;
  width: inherit;
  text-align: center;
  text-decoration: none;
  border-radius: 62.5rem;
  position: relative;
  transition: all 0.3s;
  font-weight: 700;
  line-height: 1.5;
  overflow: hidden;
  font-size: 1rem;
  letter-spacing: 0.1em;
  padding: 10px 30px;
  border: 1px solid #24b5a9;
  &:hover {
    opacity: 1;
    border-color: rgb(255, 170, 59);
  }

  &::before {
    content: '';
    display: block;
    position: absolute;
    width: 0%;
    height: 100%;
    top: 0;
    left: 0;
    transition: all 0.22s ease;
  }
}
</style>
