<template>
  <div
    class="w-11/12 max-w-sm sm:w-3/5 lg:w-1/3 sm:my-5 my-8 relative z-0 rounded-lg shadow-lg md:-mr-4"
  >
    <div class="bg-white text-black rounded-lg shadow-inner overflow-hidden">
      <div
        class="block text-left text-sm sm:text-md max-w-sm mx-auto mt-2 text-black px-8 lg:px-6"
      >
        <h1 class="text-lg font-medium p-3 pb-0 text-center tracking-wide">
          {{ planName }}
        </h1>
        <h2 class="text-sm text-gray-500 text-center pb-6">
          <span class="text-3xl">{{ price }}円</span> /月
        </h2>

        {{ description }}
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
      <div class="flex items-center p-8 justify-center"></div>
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
<style lang="scss" scoped></style>
