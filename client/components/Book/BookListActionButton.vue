<template>
  <div>
    <select
      v-model="selectedAction"
      class="appearance-none bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline"
    >
      <option value="delete">選択された項目を削除</option>
    </select>
    <AppLoadingSmallButton
      initial-label="実行"
      completed-label="完了しました"
      @onClick="onActionButtonClicked"
    />
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
