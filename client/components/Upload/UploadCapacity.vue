<template>
  <div>
    <p>
      あなたのアップロード可能サイズは
      <span class="capacity-title">約 {{ bite2MegaBite(capacity) }} MB</span
      >です<br />
      <span class="small-description"
        >(※ZIPファイルのサイズではなく、展開後の総ファイルサイズの1.4倍がアップロード可能なサイズです)</span
      >
    </p>
  </div>
</template>
<script lang="ts">
import { ref } from 'nuxt-composition-api'
export default {
  name: 'UplodeCapacity',
  props: {
    capacity: {
      type: Number,
      default: 0,
      required: false,
    },
  },
  setup() {
    const bite2MegaBite = (size: number) => {
      if (size === 0) return 0
      return Math.floor(size / (1024 * 1024))
    }
    return { bite2MegaBite }
  },
}
</script>
<style lang="scss" scoped>
.capacity-title {
  font-size: 1.6rem;
}
.small-description {
  font-size: 0.8rem;
}
</style>
