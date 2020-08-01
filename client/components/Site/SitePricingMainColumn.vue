<template>
  <div
    class="w-full max-w-md sm:w-2/3 lg:w-1/3 sm:my-5 my-8 relative z-10 bg-white rounded-lg shadow-xl"
  >
    <div
      class="leading-none rounded-t-lg bg-gray-200 text-white uppercase py-4 text-center tracking-wide gradient"
    >
      <span class="inline-block text-sm mb-3 font-semibold"
        >一番人気、全部タダ！</span
      >
      <h3 class="text-xl font-bold">Freeプラン</h3>
    </div>
    <div
      class="block text-left text-sm sm:text-md font-bold max-w-sm mx-auto mt-2 text-black px-8 lg:px-6"
    >
      <h2 class="text-sm text-gray-800 text-center pb-3">
        <span class="text-3xl">0円</span> /月
      </h2>
      <p class="text-center leading-tight">
        一日に<span class="text-xl">50MB</span
        >分のファイルを<br />アップロード可能。
      </p>
    </div>
    <div class="flex flex-wrap mt-3 px-6">
      <ul>
        <li class="flex items-center">
          <div class="rounded-full p-2 fill-current text-green-700">
            <IconCheckOk />
          </div>
          <span class="text-gray-700 text-lg ml-3">{{ subDes[0] }}</span>
        </li>
        <li class="flex items-center">
          <div class="rounded-full p-2 fill-current text-green-700">
            <IconCheckOk />
          </div>
          <span class="text-gray-700 text-lg ml-3">{{ subDes[1] }}</span>
        </li>
        <li class="flex items-center">
          <div class="rounded-full p-2 fill-current text-green-700">
            <IconCheckOk />
          </div>
          <span class="text-gray-700 text-lg ml-3">
            {{ subDes[2] }}
          </span>
        </li>
      </ul>
    </div>
    <div class="block flex items-center p-8 justify-center">
      <AppPlanButton label="新規登録する" />
    </div>
  </div>
</template>
<script lang="ts">
import { ref, PropType } from 'nuxt-composition-api'
export default {
  name: '',
  props: {
    planName: {
      type: String,
      default: '',
      required: false,
    },
    price: {
      type: String,
      default: '',
      required: false,
    },
    description: {
      type: String,
      default: '',
      required: false,
    },
    subDes: {
      type: Array as PropType<string[]>,
      default: ['', '', ''],
      required: false,
    },
  },
  setup() {
    return {}
  },
}
</script>
<style lang="scss" scoped>
.gradient {
  background-image: linear-gradient(19deg, #ff5858 0%, #f857a6 100%);
}
</style>
