<template>
  <div>
    <AppLoadingButton
      initial-label="ダウンロード"
      completed-label="成功しました"
      :status="status"
      @onClick="onClick()"
    />
    <button @click="onClick()">fff</button>
    <button @click="onActionClicked()">消す</button>
    <table>
      <tr v-for="book in list2" :key="book.book_id">
        <td>
          <input v-model="bookIds" type="checkbox" :value="book.book_id" />
        </td>
        <td>{{ book.book_id }}</td>
        <td>{{ book.book_name }}</td>
      </tr>
    </table>
  </div>
</template>

<script lang="ts">
import { ref, onMounted } from '@vue/composition-api'
import axios, { AxiosResponse } from 'axios'
export default {
  name: 'Login',
  layout: 'default',
  setup() {
    const list2 = ref([])
    const status = ref('UNINITIALIZED')
    const error = ref(null)
    const onClick = async () => {
      const res: void | AxiosResponse = await axios
        .get(
          'http://localhost:8080/api/capacities/3OfY3rPywDtU749NjsuynhiyOS9mjbRZPw4i'
        )
        .catch((e) => {
          console.log(e)
          console.log(e.response)
        })
      console.log(res.data.message)
    }

    return {
      list2,
      error,
      status,
      onClick,
    }
  },
}
</script>

<style></style>
