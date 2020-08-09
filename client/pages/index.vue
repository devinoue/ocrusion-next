<template>
  <div class="">
    <div class="image-back">
      <div class="gradient-back">
        <SiteHero2 />
        <SiteSeparator />
      </div>
    </div>

    <AppLeading
      id="feature"
      :title="'FEATURE'"
      :sub-title="'機能・特徴'"
      class="text-center bg-white"
    />
    <SiteFeature />
    <div class="bg-grey-50 py-8">
      <AppLeading
        id="plan"
        :title="'PLAN'"
        :sub-title="'プラン一覧'"
        class="text-center"
      />
      <SitePricing />
    </div>

    <AppLeading
      :title="'FAQ'"
      :sub-title="'よくあるご質問'"
      class="text-center"
    />
    <SiteFaq />
    <SiteMessage />
    <SiteFooter />
  </div>
</template>

<script lang="ts">
/**
<a href='https://www.freepik.com/free-photos-vectors/school'>School vector created by macrovector - www.freepik.com</a>

 */

import { ref, SetupContext } from '@vue/composition-api'
export default {
  name: 'Index',
  head: {
    title: '自炊をOCRする高性能AIをお求めなら',
  },
  layout: 'default',
  setup(_props: {}, { root }: SetupContext) {
    return {}
  },
}
</script>

<style lang="scss" scoped>
.anime-enter-active {
  transition: opacity 0.25s ease-out;
}

.anime-leave-active {
  transition: opacity 0.25s ease-in;
}

.anime-enter,
.anime-leave-active {
  opacity: 0;
}
.bg-grey-50 {
  background-color: #f5f7fa;
  background-color: rgba(245, 247, 250, 1);
}
.image-back {
  position: relative;
  background-image: url(../static/back1.jpg);
  background-size: cover;
  background-position: center;
  background-color: rgba(46, 46, 46, 0.726);
  background-blend-mode: darken;
  z-index: 0;

  &::before {
    content: '';
    background: inherit;
    -webkit-filter: blur(5px);
    -moz-filter: blur(5px);
    -o-filter: blur(5px);
    -ms-filter: blur(5px);
    position: absolute;
    top: -5px;
    bottom: 10px;
    left: -5px;
    right: -5px;
    filter: blur(4px);
    z-index: -4;
  }
}
.mode-blur {
  &::before {
    content: '';
    filter: blur(32px);
  }
}
.gradient-back {
  bottom: -2px;
  background: linear-gradient(
    137deg,
    #81d3e11f,
    #00b7d75b 12%,
    rgba(45, 140, 236, 0.568) 30%,
    #5860ff67 47%,
    rgba(105, 95, 244, 0.322) 58%,
    #ae5bcb
  );
}
</style>
