<template>
  <div
    class="flex justify-between items-center sticky-class mt-3 mb-12"
    :class="headerClass"
  >
    <div
      class="w-full max-w-6 mr-4 mx-auto flex py-0 justify-between items-center"
    >
      <nuxt-link class="mx-6 md:mx-0" to="/">
        <h1>
          <img
            src="~/static/logo.png"
            class="main-logo pl-5 w-1/2 md:w-1/3"
            alt="自炊OCRアプリ"
            :class="imgFilterClass"
          />
        </h1>
      </nuxt-link>
      <div class="block lg:hidden z-50">
        <button
          class="flex items-center p-2 rounded appearance-none focus:outline-none"
          @click="isHidden = !isHidden"
        >
          <svg
            class="fill-current h-5 w-5"
            viewBox="0 0 20 20"
            xmlns="http://www.w3.org/2000/svg"
          >
            <title>Menu</title>
            <path
              fill="black"
              d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"
            />
          </svg>
        </button>
      </div>
      <TheMainMenu
        class="lg:hidden fixed top-0 left-0 fixed-menu"
        :is-member="!isTop"
        :is-over-scroll-limit="true"
        :class="{ hidden: isHidden }"
      />
      <TheMainMenu
        :is-member="!isTop"
        :is-over-scroll-limit="scrollY >= 900"
        class="hidden lg:block"
      />
    </div>
  </div>
</template>
<script lang="ts">
import { ref, onMounted, SetupContext, computed } from 'nuxt-composition-api'
// import { ref } from 'nuxt-composition-api'
export default {
  name: '',
  props: {
    isTop: {
      type: Boolean,
      default: true,
    },
  },
  setup(_props: {}, { root }: SetupContext) {
    const scrollY = ref(0)
    const isHidden = ref(true)
    const calculateScrollY = () => {
      scrollY.value = window.scrollY
    }
    onMounted(() => {
      window.addEventListener('scroll', calculateScrollY)
    })

    const imgFilterClass = computed(() => {
      return root.$route.path === '/' && scrollY.value < 900
        ? ['img-filter']
        : null
    })
    const headerClass = computed(() => {
      // return
      return scrollY.value >= 900
        ? ['w-full', 'bg-gray-100', 'rounded-lg', 'shadow-lg']
        : null
    })
    return { headerClass, imgFilterClass, scrollY, isHidden }
  },
}
</script>
<style lang="scss" scoped>
.fixed-menu {
  top: 0;
  width: 100%;
  padding: 20px;
  padding-left: 30px;
  background-color: rgba(241, 240, 243, 0.952);
  z-index: 10;
}

.img-filter {
  filter: invert(100%) sepia(100%) saturate(0%) hue-rotate(229deg)
    brightness(107%) contrast(101%);
}
.main-logo {
  box-sizing: border-box;
  // width: 30%;
}
.sticky-class {
  height: 60px;
  padding: 10px;
}
</style>
