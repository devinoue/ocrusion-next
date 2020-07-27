<template>
  <nav>
    <span class="px-6 text-sm font-bold text-gray-500"
      >本を自炊して快適な読書を支援するOCRサービス「OCRusion」</span
    >
    <div class="my-0 px-6 flex justify-between items-center">
      <a class="font-bold text-2xl lg:text-4xl" href="#">
        自炊OCRアプリ
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
  </nav>
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
<style lang="scss" scoped></style>
