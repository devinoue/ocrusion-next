<template>
  <div>
    <nav class="z-50 max-w-6xl mx-auto" :class="headerClass">
      <TheHeader :is-top="true" />
    </nav>

    <nuxt />
  </div>
</template>

<script lang="ts">
import { computed, ref, onMounted } from 'nuxt-composition-api'
export default {
  setup() {
    const scrollY = ref(0)
    const calculateScrollY = () => {
      scrollY.value = window.scrollY
      console.log(scrollY.value)
    }
    onMounted(() => {
      window.addEventListener('scroll', calculateScrollY)
    })

    const headerClass = computed(() => {
      console.log(scrollY.value)
      return
      return scrollY.value > 900
        ? ['sticky', 'top-0', 'bg-white', 'pb-0', 'w-full', 'pt-6']
        : ['max-w-6xl', 'mx-auto']
    })
    return { headerClass }
  },
}
</script>

<style lang="scss" scoped></style>
