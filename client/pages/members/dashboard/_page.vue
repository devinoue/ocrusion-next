<template>
  <div>
    <AppLeading :title="'BOOKS'" :sub-title="'本一覧'" class="text-center" />

    <BookList
      v-if="bookList.length !== 0"
      :book-list="bookList"
      @onActionButtonClicked="onActionButtonClicked"
    />
    <div v-if="bookList.length === 0 && hadNoBooks" class="pt-24 text-center">
      <h2 class="text-xl font-semibold">❌データがありません</h2>
      <span class="inline-block pt-3"
        ><nuxt-link to="/members/upload" class="link-text font-semibold"
          >アップロード画面</nuxt-link
        >から、ファイルのアップロードを開始してください。</span
      >
    </div>
    <div v-if="isFullDeleted" class="pt-24 text-center">
      <h2 class="text-xl font-semibold">無事処理できました。</h2>
      <span class="inline-block pt-3"
        ><nuxt-link to="/members/dashboard/1" class="link-text font-semibold"
          >一覧画面</nuxt-link
        >にお戻りください。</span
      >
    </div>
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
  head: {
    title: '本一覧',
  },
  setup(_props: {}, { root }: SetupContext) {
    const page = root.$route.params?.page ?? 1
    const userId = root.$store.getters['Auth/user'].id

    const bookList = ref([])
    const bookData = ref<any>({})
    const hadNoBooks = ref(false)
    const isFullDeleted = ref(false)
    const { changeLoaded, changeLoading, changeFailure, request } = useLoading()
    onMounted(async () => {
      // changeUninitialized()
      try {
        changeLoading()
        const res = await axios.get(`/api/user/${userId}?page=${page}`)

        bookData.value = res.data
        bookList.value = res.data.data ?? []
        if (bookList.value.length === 0) hadNoBooks.value = true
        changeLoaded()
      } catch (e) {
        if (e.response) {
          alert(`${e.message}`)
        } else if (e.message.includes('Network')) {
          alert(
            'ネットワーク障害が発生しています。しばらくしてからアクセスしてください。'
          )
        } else {
          alert(`${e.message}`)
        }
      }
    })

    const onActionButtonClicked = async (ids: string[]) => {
      try {
        changeLoading()
        const params = { bookIds: JSON.stringify(ids) }
        await axios.post(`/api/book`, params)

        changeLoaded()
      } catch (e) {
        alert(`${e.message}`)
        changeFailure()
        return
      }

      const rest = bookList.value.filter(
        // eslint-disable-next-line camelcase
        ({ book_id }: IBookList) => !ids.includes(book_id)
      )
      bookList.value = rest
      if (bookList.value.length === 0) {
        isFullDeleted.value = true
        root.$router.push('/members/dashboard/#')
      }
    }

    return {
      bookData,
      bookList,
      onActionButtonClicked,
      request,
      hadNoBooks,
      isFullDeleted,
      RequestState,
    }
  },
}
</script>
<style lang="scss" scoped>
.link-text {
  transition: all 0.3s ease;
  position: relative;
  z-index: 44;
  display: inline-block;
  &::after {
    content: '';
    display: block;
    position: absolute;
    width: 100%;
    height: 0.625rem;
    background-color: #f0eb47;
    bottom: 0;
    left: 0;
    opacity: 0;
    pointer-events: none;
    transition: all 0.2s ease;
  }
}
</style>
