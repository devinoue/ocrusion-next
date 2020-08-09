<template>
  <div class="flex flex-col">
    <p class="title">{{ title }}</p>
    <h2 class="subtitle">{{ subTitle }}</h2>
    <div class="h-1 mx-auto color-bar w-24 opacity-75 mt-4 rounded z-0"></div>
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
.title {
  font-weight: 500;
  pointer-events: auto;
  line-height: 1.2;
  color: #173e5ca2;
  font-size: 13px;
  font-family: 'Arial Black', 'Arial Bold', Helvetica, sans-serif;
  letter-spacing: 0.2em;
  box-sizing: inherit;
  display: inline-block;
  transition: all 200ms ease-in;
  opacity: 1;
  transition-delay: 50ms !important;
  margin: 0;
  padding: 0;
  margin-top: 10px;
}

.subtitle {
  margin-top: 10px;
  font-family: 'Noto Sans JP', sans-serif;
  font-feature-settings: 'palt';
  font-size: 1.8em;
  font-weight: 900;
}

.color-bar {
  background-color: #053657;
}
</style>
