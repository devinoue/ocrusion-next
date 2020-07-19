<template>
  <div>
    文章同士の連結文字列 :
    <input
      v-model="optionalSeparator"
      type="text"
      class="shadow w-full"
    /><br />
    <span class="text-xs"> </span>
  </div>
</template>
<script lang="ts">
import { ref, watch, defineComponent, SetupContext } from 'nuxt-composition-api'
export default defineComponent({
  name: '',
  setup(_props: {}, { emit }: SetupContext) {
    const optionalSeparator = ref(
      '────────────────────────────────────────────────'
    )
    const isTextarea = ref(false)
    watch(
      () => optionalSeparator.value,
      () => {
        const separatedText: string = optionalSeparator.value + ''
        emit('changeSeparator', separatedText.replace('[br]', '<br />'))
      }
    )

    return {
      optionalSeparator,
      isTextarea,
    }
  },
})
</script>
<style lang="scss" scoped></style>
