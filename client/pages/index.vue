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
    onMounted(async () => {
      try {
        const res = await axios.get(
          'http://localhost:8080/api/user/3OfY3rPywDtU749NjsuynhiyOS9mjbRZPw4i'
        )
        list2.value = res.data.data ?? {}
      } catch (e) {
        console.log(e)
        console.log(e.response)
      }
    })

    return {
      onActionClicked,
      list2,
      bookIds,
    }
  },
}
</script>

<style>
/* Sample `apply` at-rules with Tailwind CSS
.container {
@apply min-h-screen flex justify-center items-center text-center mx-auto;
}
*/
.container {
  margin: 0 auto;
  min-height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;
  text-align: center;
}

.title {
  font-family: 'Quicksand', 'Source Sans Pro', -apple-system, BlinkMacSystemFont,
    'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
  display: block;
  font-weight: 300;
  font-size: 100px;
  color: #35495e;
  letter-spacing: 1px;
}

.subtitle {
  font-weight: 300;
  font-size: 42px;
  color: #526488;
  word-spacing: 5px;
  padding-bottom: 15px;
}

.links {
  padding-top: 15px;
}
</style>
