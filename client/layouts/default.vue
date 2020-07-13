<template>
  <div class="container mx-auto ">
    <TheHeader />
    <nuxt />
  </div>
</template>

<script lang="ts">
import TheHeader from '~/components/App/TheHeader.vue'
export default {
  components: { TheHeader },
}
</script>

<style>

</style>
