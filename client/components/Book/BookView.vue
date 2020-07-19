<template>
  <section>
    {{ ocrText }}
  </section>
</template>
<script lang="ts">
import { ref, defineComponent } from 'nuxt-composition-api'
export default defineComponent({
  name: '',
  props: {
    ocrText: {
      type: String,
      default: '',
    },
  },
  setup() {
    return {}
  },
})
</script>
<style lang="scss" scoped></style>
