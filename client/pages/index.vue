<template>
  <div class="container">
    <div>
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
      {{ list2 }}
    </div>
  </div>
</template>

<script lang="ts">
import { ref, onMounted } from '@vue/composition-api'
import axios from 'axios'
export default {
  name: 'Login',
  layout:"default",
  setup() {
    const a = ref(process.env.API_KEY)
    const list2 = ref<any>({})
    const bookIds = ref([])
    const onActionClicked = async (bookId: string) => {
      try {
        const params = { bookIds: JSON.stringify(bookIds) }
        const res = await axios.post(`http://localhost:8080/api/book`, params)
        console.log(res.data)
      } catch (e) {
        console.log(e)
        console.log(e.response)
      }
    }
    // onMounted(async () => {
    //   try {
    //     const res = await axios.get(
    //       'http://localhost:8080/api/user/3OfY3rPywDtU749NjsuynhiyOS9mjbRZPw4i'
    //     )
    //     list2.value = res.data.data ?? {}
    //   } catch (e) {
    //     console.log(e)
    //     console.log(e.response)
    //   }
    // })

    return {
      onActionClicked,
      list2,
      bookIds,
    }
  },
}
</script>

<style>
</style>
