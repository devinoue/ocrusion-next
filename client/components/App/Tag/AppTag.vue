<template>
  <span class="inline-flex rounded-full h-6 px-3 justify-center items-center">
    {{ text }}
  </span>
</template>
<script lang="ts">
import { defineComponent } from 'nuxt-composition-api'

export default defineComponent({
  name: '',
  props: {
    text: {
      type: String,
      default: '',
    },
  },
})
</script>
