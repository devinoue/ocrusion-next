<template>
  <div>
    <AppLeading
      :title="'BOOK LIST'"
      :sub-title="'本一覧'"
      class="text-center"
    />
    <BookList
      v-if="bookList.length !== 0"
      :book-list="bookList"
      @onActionButtonClicked="onActionButtonClicked"
    />
    <div class="text-center">
      <PaginationCircle v-if="bookList.length !== 0" :book-data="bookData" />
    </div>
  </div>
</template>
<script lang="ts">
import axios from 'axios'
import { ref, onMounted, SetupContext } from '@vue/composition-api'
import { IBookList, RequestState } from '~/types/index'
import useLoading from '~/composables/use-loading'
import BookList from '~/components/Book/BookList.vue'

export default {
  name: 'Member',
  // middleware: 'auth',
  layout: 'member',
  components: { BookList },
  setup(_props: {}, { root }: SetupContext) {
    const page = root.$route.params?.page ?? 1
    const userId = root.$store.getters['Auth/user'].id
    console.log(root.$store.getters['Auth/token'])
    const bookList = ref([])
    const bookData = ref<any>({})
    const { changeLoaded, changeLoading, changeFailure, request } = useLoading()
    onMounted(async () => {
      try {
        changeLoading()
        const res = await axios.get(`/api/user/${userId}?page=${page}`)
        console.log(res)
        bookData.value = res.data
        bookList.value = res.data.data ?? []
        changeLoaded()
      } catch (e) {
        if (e.response) {
          alert(`${e.message}`)
        } else if (e.message.includes('Network')) {
          alert(
            'ネットワーク障害が発生しています。しばらくしてからアクセスしてください。'
          )
        } else {
          console.log(e)
        }
      }
    })

    const onActionButtonClicked = async (ids: string[]) => {
      try {
        changeLoading()
        const params = { bookIds: JSON.stringify(ids) }
        const res = await axios.post(`http://localhost:8080/api/book`, params)
        changeLoaded()
      } catch (e) {
        console.log(e)
        console.log(e.response)
        changeFailure()
        return
      }

      const rest = bookList.value.filter(
        // eslint-disable-next-line camelcase
        ({ book_id }: IBookList) => !ids.includes(book_id)
      )
      bookList.value = rest
    }

    return {
      bookData,
      bookList,
      onActionButtonClicked,
      request,
      RequestState,
    }
  },
}
</script>
<style lang="scss" scoped></style>
