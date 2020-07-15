<template>
  <div>
    <select v-model="selectedAction">
      <option value="delete">削除</option>
    </select>
    <button @click="onActionButtonClicked">実行</button>
  </div>
</template>
<script lang="ts">
import { ref } from 'nuxt-composition-api'
export default {
  name: '',
  setup(_props: {}, { emit }: any) {
    const selectedAction = ref('delete')
    const onActionButtonClicked = () => {
      emit('onActionButtonClicked', selectedAction.value)
    }
    return { selectedAction, onActionButtonClicked }
  },
}
</script>
<style lang="scss" scoped></style>
