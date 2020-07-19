<template>
  <div>
    <BookListActionButton @onActionButtonClicked="onActionButtonClicked" />
    <table class="w-full rounded-lg overflow-hidden my-5">
      <thead>
        <tr class="bg-teal-400 rounded-l-lg mb-2 sm:mb-0">
          <th width="60px" class="p-3 text-left">操作</th>
          <th class="p-3 text-left">名前</th>

          <th width="50%" class="p-3 text-left">説明</th>
          <th class="p-3 text-left">状態</th>
        </tr>
      </thead>
      <tbody class="flex-1 sm:flex-none">
        <tr
          v-for="book in bookList"
          :key="book.book_id"
          class="flex flex-col flex-no wrap sm:table-row mb-2 sm:mb-0 hover:bg-gray-100 transition"
        >
          <td class="border-grey-light border p-3">
            <input
              v-model="selectedBookIds"
              type="checkbox"
              class="form-checkbox"
              :value="book.book_id"
            />
          </td>
          <td class="border-grey-light border p-3 font-semibold">
            <span v-show="book.state === 0">{{ book.book_name }}<br /></span>
            <nuxt-link
              v-show="book.state === 1"
              :to="'/members/books/' + book.book_id"
            >
              <span>{{ book.book_name }}<br /></span>
            </nuxt-link>

            <span>
              <AppTag
                v-show="book.state === 0"
                :text="'OCR待機中...'"
                class="bg-pink-600 text-white text-xs"
              />
              <AppTag
                v-show="book.state === 1"
                :text="'OCR処理済み'"
                class="bg-indigo-600 text-white text-xs"
              />
            </span>
          </td>
          <td class="border-grey-light border p-3">
            <p>{{ book.description }}</p>
            <span class="updatedat"
              >Updated at {{ displayDate(book.updated_at) }}</span
            >
          </td>
          <td class="border-grey-light border p-3 truncate">
            {{ displayState(book.state) }}
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>
<script lang="ts">
import { ref, defineComponent } from 'nuxt-composition-api'
import axios from 'axios'
import BookListActionButton from '~/components/Book/BookListActionButton.vue'
export default defineComponent({
  name: '',
  components: { BookListActionButton },
  props: {
    bookList: {
      default: [],
      type: Array,
    },
  },
  setup() {
    const selectedBookIds = ref([])
    const displayState = (value: number) => {
      return value === 0 ? '待機中' : 'OCR済み'
    }
    const displayDate = (value: string) => {
      return new Date(value).toLocaleString()
    }
    const onActionButtonClicked = async (action: string) => {
      // delete
      if (action === 'delete') {
        try {
          const params = { bookIds: JSON.stringify(selectedBookIds.value) }
          const res = await axios.post(`http://localhost:8080/api/book`, params)
          console.log(res.data)
        } catch (e) {
          console.log(e)
          console.log(e.response)
        }
      }
    }
    return { onActionButtonClicked, displayState, displayDate, selectedBookIds }
  },
})
</script>
<style lang="scss" scoped>
.updatedat {
  font-size: 0.7rem;
  color: #adadad;
}
</style>
