<template>
  <div>
    <div class="w-screen fixed top-0 z-50">
      <TheHeader :is-top="true" class="max-w-6xl mx-auto" />
    </div>

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
    }
    onMounted(() => {
      window.addEventListener('scroll', calculateScrollY)
    })

    const headerClass = computed(() => {
      // console.log(scrollY.value)
      return
      return scrollY.value > 0
        ? [
            'sticky',
            'sticky-class',
            'bg-white',
            'pb-0',
            'w-full',
            'rounded-full',
          ]
        : ['max-w-6xl', 'mx-auto', 'm-t']
    })
    return { headerClass }
  },
}
</script>

<style lang="scss" scoped>
.centering {
  left: 50%;
  transform: translate(-50%, 0);
}
.anime-enter-active {
  transition: opacity 0.5s ease-out;
}

.anime-leave-active {
  transition: opacity 0.5s ease-in;
}

.anime-enter,
.anime-leave-active {
  opacity: 0;
}
</style>
