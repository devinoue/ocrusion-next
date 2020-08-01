<template>
  <div>
    <SiteHero />
    <AppLeading
      id="feature"
      :title="'FEATURE'"
      :sub-title="'機能・特徴'"
      class="text-center"
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
</style>
