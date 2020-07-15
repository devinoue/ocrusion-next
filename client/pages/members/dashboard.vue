<template>
  <div>
    <AppLeading
      :title="'BOOK LIST'"
      :sub-title="'本一覧'"
      class="text-center"
    />
    <BookList v-if="bookList.length !== 0" :book-list="bookList" />
    <div class="text-center"><PaginationCircle :book-data="bookData" /></div>
  </div>
</template>
<script lang="ts">
import axios from 'axios'
import { ref, onMounted } from 'nuxt-composition-api'
import BookList from '~/components/Book/BookList.vue'
import AppLeading from '~/components/App/AppLeading.vue'
import AppPagenation from '~/components/App/AppPagenation.vue'

export default {
  name: 'Member',
  // middleware: 'auth',
  layout: 'member',
  components: { BookList, AppLeading, AppPagenation },
  setup(_props: {}) {
    const bookList = ref([])
    const bookData = ref<any>({})
    onMounted(async () => {
      try {
        const res = await axios.get(
          'http://localhost:8080/api/user/3OfY3rPywDtU749NjsuynhiyOS9mjbRZPw4i'
        )
        bookData.value = res.data
        bookList.value = res.data.data ?? []
      } catch (e) {
        console.log(e)
        console.log(e.response)
      }
    })

    return {
      bookData,
      bookList,
    }
  },
}
</script>
<style lang="scss" scoped></style>
