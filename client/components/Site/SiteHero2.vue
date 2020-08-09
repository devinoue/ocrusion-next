<template>
  <!--Hero-->
  <section class="w-full h-screen pt-32 md:max-w-6xl md:mx-auto">
    <div class="flex flex-col md:flex-row">
      <div
        class="mx-4flex flex w-full flex-wrap flex-col md:flex-row items-center"
      >
        <!--Left Col-->
        <div
          class="md:flex md:flex-col w-full md:w-1/2 md:justify-center md:items-start text-white text-center md:text-left"
        >
          <div class="big-text mx-4 md:mx-0 md:mt-20">
            積ん読は<br />まとめてテキストに。
          </div>
          <p class="mt-6 block font-semibold hero-text md:text-xl">
            AIが画像からテキストを抽出
          </p>
          <p class="font-semibold hero-text">
            簡単操作で読書を楽しもう &#x1f377;
          </p>

          <nuxt-link
            to="/auth/register"
            class="mx-auto lg:mx-0 bg-white font-semibold rounded-full my-6 py-4 px-8 shadow-lg btn"
          >
            新規登録する
          </nuxt-link>
        </div>
        <!--Right Col-->
        <div class="md:w-1/2 z-50">
          <SiteHeroImage class="img" />
          <!-- <img class="img" src="hero.svg" />-->
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
.big-text {
  color: white;
  flex: none;
  font-size: 52px;
  font-style: normal;
  font-weight: 900;
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
</style>
