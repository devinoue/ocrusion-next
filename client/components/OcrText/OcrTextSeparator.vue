<template>
  <div>
    <div class="">
      <label class="block text-sm text-gray-600">
        文章同士の連結に使う文字列
      </label>
      <input
        v-model="optionalSeparator"
        type="text"
        class="shadow w-full px-5 py-1 text-gray-700 bg-gray-200 rounded"
      />
    </div>
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
