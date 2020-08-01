<template>
  <section class="w-full bg-image mb-24">
    <div class="md:max-w-6xl md:mx-auto flex flex-col md:flex-row">
      <div class="mx-4 md:w-1/2 flex flex-col items-center md:items-start">
        <div class="mx-4 md:mx-0 md:mt-20">
          <img src="~/static/title.png" />
        </div>
        <p class="mt-6 block font-bold hero-text md:text-xl">
          簡単操作でAIが画像からテキストを抽出
        </p>
        <p class="font-bold hero-text">読書を楽しもう &#x1f377;</p>
      </div>
      <div class="md:w-1/2"></div>
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
.bg-image {
  background-image: url(../../static/4.png);
  background-size: cover;
  background-position: center;
  width: 100%;
  height: 80vh;
  //   border: 1px solid #000;
}
.hero-text {
  font-family: 'Hiragino Kaku Gothic Pro', 'メイリオ', 'ＭＳ Ｐゴシック',
    sans-serif;
}
</style>
