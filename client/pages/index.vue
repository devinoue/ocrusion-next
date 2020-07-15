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
    </div>
  </div>
</template>

<script lang="ts">
import { ref, onMounted } from '@vue/composition-api'
import axios from 'axios'
export default {
  name: 'Login',
  layout: 'default',
  setup() {
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

    return {
      onActionClicked,

      bookIds,
    }
  },
}
</script>

<style></style>
