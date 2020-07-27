<template>
  <div class="container mx-auto">
    <TheHeader :is-top="false" />
    <nuxt />
  </div>
</template>
<script lang="ts">
export default {
  middleware: 'auth',
}
</script>

<style></style>
