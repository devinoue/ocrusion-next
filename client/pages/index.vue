<template>
  <div class="">
    <div class="gradient">
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
    <SiteFooter />
  </div>
</template>

<script lang="ts">
/**
<a href='https://www.freepik.com/free-photos-vectors/school'>School vector created by macrovector - www.freepik.com</a>

 */

import { ref, SetupContext } from '@vue/composition-api'
import axios from 'axios'
export default {
  name: 'Login',
  head: {
    title: '自炊をOCRする高性能AIをお求めなら',
  },
  layout: 'default',
  setup(_props: {}, { root }: SetupContext) {
    const list2 = ref([])
    console.log(root.$store.getters['Auth/token'])
    root.$store.commit('Auth/SET_TOKEN', 'fffhffff')
    console.log(root.$store.getters['Auth/token'])
    const status = ref('UNINITIALIZED')
    const error = ref(null)
    const onClick = async () => {
      axios
        .get(
          'http://localhost:8080/api/capacities/3OfY3rPywDtU749NjsuynhiyOS9mjbRZPw4i'
        )
        .then((res) => {
          console.log(res.data.message)
        })
        .catch((e) => {
          console.log(e)
          console.log(e.response)
        })
    }

    return {
      list2,
      error,
      status,
      onClick,
    }
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
.gradient {
  background-image: url(../static/back1.jpg);
  background-size: cover;
  background-position: center;
  background-color: rgba(46, 46, 46, 0.726);
  background-blend-mode: darken;
}
.gradient-back {
  background: linear-gradient(
    137deg,
    #81d3e11f,
    #00b7d75b 12%,
    rgba(45, 140, 236, 0.568) 30%,
    #5860ff1c 47%,
    rgba(105, 95, 244, 0.322) 58%,
    #ae5bcb
  );
}
</style>
