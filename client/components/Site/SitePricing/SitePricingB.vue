<template>
  <section class="bg-gray-100 py-8">
    <div class="container mx-auto px-2 pt-4 pb-12 text-gray-800">
      <div class="flex flex-col sm:flex-row justify-center pt-12 my-12 sm:my-4">
        <div
          class="flex flex-col w-5/6 lg:w-1/4 mx-auto lg:mx-0 rounded-none lg:rounded-l-lg bg-white mt-4"
        >
          <div
            class="flex-1 bg-white text-gray-600 rounded-t rounded-b-none overflow-hidden shadow"
          >
            <div class="p-8 text-3xl font-bold text-center border-b-4">
              Free
            </div>
            <ul class="w-full text-center text-sm">
              <li class="border-b py-4">Thing</li>
              <li class="border-b py-4">Thing</li>
              <li class="border-b py-4">Thing</li>
            </ul>
          </div>
          <div
            class="flex-none mt-auto bg-white rounded-b rounded-t-none overflow-hidden shadow p-6"
          >
            <div
              class="w-full pt-6 text-3xl text-gray-600 font-bold text-center"
            >
              £0 <span class="text-base">for one user</span>
            </div>
            <div class="flex items-center justify-center">
              <button
                class="mx-auto lg:mx-0 hover:underline gradient text-white font-bold rounded-full my-6 py-4 px-8 shadow-lg"
              >
                Sign Up
              </button>
            </div>
          </div>
        </div>

        <div
          class="flex flex-col w-5/6 lg:w-1/3 mx-auto lg:mx-0 rounded-lg bg-white mt-4 sm:-mt-6 shadow-lg z-10"
        >
          <div
            class="flex-1 bg-white rounded-t rounded-b-none overflow-hidden shadow"
          >
            <div class="w-full p-8 text-3xl font-bold text-center">
              フリープラン
            </div>
            <div class="h-1 w-full gradient my-0 py-0 rounded-t"></div>
            <ul class="w-full text-center text-base font-bold">
              <li class="border-b py-4">Thing</li>
              <li class="border-b py-4">Thing</li>
              <li class="border-b py-4">Thing</li>
              <li class="border-b py-4">Thing</li>
            </ul>
          </div>
          <div
            class="flex-none mt-auto bg-white rounded-b rounded-t-none overflow-hidden shadow p-6"
          >
            <div class="w-full pt-6 text-4xl font-bold text-center">
              0円 <span class="text-base">/ 一ヶ月</span>
            </div>
            <div class="flex items-center justify-center">
              <button
                class="mx-auto lg:mx-0 hover:underline gradient text-white font-bold rounded-full my-6 py-4 px-8 shadow-lg"
              >
                Sign Up
              </button>
            </div>
          </div>
        </div>

        <div
          class="flex flex-col w-5/6 lg:w-1/4 mx-auto lg:mx-0 rounded-none lg:rounded-l-lg bg-white mt-4"
        >
          <div
            class="flex-1 bg-white text-gray-600 rounded-t rounded-b-none overflow-hidden shadow"
          >
            <div class="p-8 text-3xl font-bold text-center border-b-4">
              プロフェッショナル
            </div>
            <ul class="w-full text-center text-sm">
              <li class="border-b py-4 test">セットアップ不要</li>
              <li class="border-b py-4 test">一日最大50MB</li>
              <li class="border-b py-4 test">テキスト出力</li>
            </ul>
          </div>
          <div
            class="flex-none mt-auto bg-white rounded-b rounded-t-none overflow-hidden shadow p-6"
          >
            <div
              class="w-full pt-6 text-3xl text-gray-600 font-bold text-center"
            >
              要相談 <span class="text-base">/ per user</span>
            </div>
            <div class="flex items-center justify-center">
              <button
                class="mx-auto lg:mx-0 hover:underline gradient text-white font-bold rounded-full my-6 py-4 px-8 shadow-lg"
              >
                Sign Up
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>
<script lang="ts">
import { ref } from 'nuxt-composition-api'
export default {
  name: '',
  setup() {
    return {}
  },
}
</script>
<style lang="scss" scoped>
.test {
  position: relative;
  font-size: 12px;
  &::before {
    left: -29px;
    font-size: 12px;
    position: absolute;
    content: url('data:image/svg+xml;utf-8,<svg fill="green" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.959 17l-4.5-4.319 1.395-1.435 3.08 2.937 7.021-7.183 1.422 1.409-8.418 8.591z"/></svg>');
  }
}
</style>
