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
      <ul class="w-full">
        <li class="flex items-center border-b">
          <div class="rounded-full p-2 fill-current text-green-700">
            <IconCheckOk />
          </div>
          <span class="text-gray-700 text-lg ml-3">{{ subDes[0] }}</span>
        </li>
        <li class="flex items-center border-b">
          <div class="rounded-full p-2 fill-current text-green-700">
            <IconCheckOk />
          </div>
          <span class="text-gray-700 text-lg ml-3">{{ subDes[1] }}</span>
        </li>
        <li class="flex items-center border-b">
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
      <nuxt-link
        to="/auth/register"
        class="mx-auto lg:mx-0 bg-white font-semibold rounded-full my-6 py-4 px-8 shadow-lg btn"
      >
        新規登録する
      </nuxt-link>
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
.btn {
  cursor: pointer;
  transition: 450ms cubic-bezier(0.25, 0.46, 0.45, 0.94);
  transition-property: opacity, color;
  display: flex;
  overflow: hidden;
  position: relative;
  z-index: 1;
  width: 100%;
  color: #1a1a1a;
  text-align: center;
  -webkit-box-align: center;
  align-items: center;
  -webkit-box-pack: center;
  justify-content: center;
  max-width: 230px;

  &::before {
    position: absolute;
    z-index: -1;
    top: 0;
    left: -101%;
    width: 100%;
    height: 100%;
    background-color: #041431fb;
    opacity: 0.2;
    content: '';
    -webkit-transition: 300ms cubic-bezier(0.25, 0.46, 0.45, 0.94);
    transition: 300ms cubic-bezier(0.25, 0.46, 0.45, 0.94);
  }
  &:hover {
    color: white;
    &::before {
      left: 0;
      opacity: 1;
    }
  }
}
</style>
