<template>
  <div class="mx-4 leading-none mt-3 mb-12">
    <span class="inline-block text-sm font-bold text-gray-500 pb-3"
      >本を自炊して快適な読書を支援するOCRサービス「自炊OCRアプリ」</span
    >
    <div class="py-0 flex justify-between items-center">
      <a class="font-bold text-2xl md:text-4xl" href="#">
        <img src="~/static/logo.png" class="main-logo" />
      </a>
      <div class="block lg:hidden">
        <button
          class="flex items-center px-3 py-2 border rounded text-gray-500 border-gray-600 hover:text-gray-800 hover:border-teal-500 appearance-none focus:outline-none"
        >
          <svg
            class="fill-current h-3 w-3"
            viewBox="0 0 20 20"
            xmlns="http://www.w3.org/2000/svg"
          >
            <title>Menu</title>
            <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z" />
          </svg>
        </button>
      </div>
      <TheMainMenu :is-member="!isTop" />
    </div>
  </div>
</template>
<script lang="ts">
// import { ref } from 'nuxt-composition-api'
export default {
  name: '',
  props: {
    isTop: {
      type: Boolean,
      default: true,
    },
  },
  setup() {
    return {}
  },
}
</script>
<style lang="scss" scoped>
.main-logo {
  box-sizing: border-box;
  width: 50%;
}
</style>
