<template>
  <!--Hero-->
  <section class="w-full">
    <div class="md:max-w-6xl md:mx-auto flex flex-col md:flex-row">
      <div class="mx-4flex flex flex-wrap flex-col md:flex-row items-center">
        <!--Left Col-->
        <div
          class="md:flex md:flex-col md:w-1/2 md:justify-center md:items-start text-white text-center md:text-left"
        >
          <div class="big-text mx-4 md:mx-0 md:mt-20">
            積ん読を、<br />まとめてテキストに
          </div>
          <p class="mt-6 block font-bold hero-text md:text-xl">
            簡単操作でAIが画像からテキストを抽出
          </p>
          <p class="font-bold hero-text">読書を楽しもう &#x1f377;</p>

          <button
            class="mx-auto lg:mx-0 hover:underline bg-white text-gray-800 font-bold rounded-full my-6 py-4 px-8 shadow-lg"
          >
            Subscribe
          </button>
        </div>
        <!--Right Col-->
        <div class="md:w-1/2">
          <img class="z-50 img" src="hero.png" />
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
.big-text {
  color: white;
  flex: none;
  font-family: 'Noto Sans JP', sans-serif;
  font-size: 52px;
  font-style: normal;
  font-weight: 700;
  height: auto;
  line-height: 1.3;
  margin: 0 0 0 0;
  padding: 0 0 0 0;
  width: auto;
  z-index: 2;
  max-width: 100%;
  justify-content: flex-start;
}
.img {
  max-width: 100%;
  height: auto;
}
.bg-image {
  background-image: url(../../static/hero.png);
  background-size: cover;
  background-position: center;
  width: 100%;
  height: 80vh;
  //   border: 1px solid #000;
}
</style>
