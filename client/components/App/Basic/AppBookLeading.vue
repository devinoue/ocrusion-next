<template>
  <div class="flex flex-col">
    <h2 class="book-title">{{ title }}</h2>
    <p class="book-subtitle">{{ subTitle }}</p>
  </div>
</template>
<script lang="ts">
export default {
  name: '',
  props: {
    title: {
      type: String,
      default: '',
    },
    subTitle: {
      type: String,
      default: '',
    },
  },
  setup() {
    return {}
  },
}
</script>
<style lang="scss" scoped>
.book-subtitle {
  font-family: 'Noto Sans JP', sans-serif;
  font-feature-settings: 'palt';
  font-size: 1.8em;
  font-weight: 900;
}
</style>
