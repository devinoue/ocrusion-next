<template>
  <div class="flex flex-col">
    <p class="title">{{ title }}</p>
    <h2 class="subtitle">{{ subTitle }}</h2>
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
<style lang="scss" scoped></style>
