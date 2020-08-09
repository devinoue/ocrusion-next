<template>
  <div>a : {{ g }}</div>
</template>
<script lang="ts">
import { ref, SetupContext } from 'nuxt-composition-api'
export default {
  name: '',
  layout: 'member',
  setup(_props: {}, { root }: SetupContext) {
    const g = root.$store.getters['Auth/token']
    return { g }
  },
}
</script>
<style lang="scss" scoped></style>
