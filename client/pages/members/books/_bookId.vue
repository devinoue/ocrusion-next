<template>
  <div class="container mx-auto">
    <AppFullScreenLoading
      v-if="request.state === RequestState.LOADING"
      leading="読み込み中..."
      comment=""
    />
    <div class="my-6">
      <AppBookLeading :title="bookName" :sub-title="''" class="text-center" />
    </div>
    <section
      v-if="mode === 'display' && request.state !== RequestState.LOADING"
      class="w-full mx-auto m-4 p-10 text-gray-700 bg-white rounded shadow-xl"
    >
      <!-- <button class="shadow" @click="changeMode">編集モードへ</button> -->
      {{ displayDate }}
      <OcrTextDisplay :ocr-texts="ocrTexts" />
    </section>
    <section v-else-if="mode === 'edit'">
      <button class="shadow" @click="changeMode">表示モードへ</button>
      <OcrTextEdit :ocr-texts="ocrTexts" />
    </section>

    <br />
  </div>
</template>
<script lang="ts">
import { ref, onMounted, SetupContext, computed } from 'nuxt-composition-api'
import axios from 'axios'
import useLoading from '../../../composables/use-loading'
import { RequestState } from '../../../types/index'

export default {
  name: '',
  layout: 'member',
  setup(_props: {}, ctx: SetupContext) {
    const { changeLoaded, changeLoading, changeFailure, request } = useLoading()
    const bookId = ctx.root.$route.params?.bookId ?? null
    const mode = ref<'edit' | 'display'>('display')
    if (bookId === null) {
      //
    }
    const ocrTexts = ref<any>([])
    const bookDetails = ref<any>({})
    const changeMode = () => {
      return mode.value === 'edit'
        ? (mode.value = 'display')
        : (mode.value = 'edit')
    }
    const bookName = computed(() => {
      // eslint-disable-next-line camelcase
      return bookDetails.value?.book_name ?? ''
    })

    const displayDate = computed(() => {
      // eslint-disable-next-line camelcase
      return bookDetails.value?.updated_at
        ? 'Updated at ' +
            new Date(bookDetails.value.updated_at).toLocaleString()
        : ''
    })
    onMounted(async () => {
      try {
        changeLoading()
        const baseApi = axios.create({ baseURL: 'http://localhost:8080' })
        const result = await baseApi.get(`/api/book/${bookId}`)
        console.log(result)
        ocrTexts.value = result.data.ocrTexts
        bookDetails.value = result.data.imageDirs
        changeLoaded()
      } catch (e) {
        changeFailure()
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
    return {
      ocrTexts,
      bookDetails,
      mode,
      changeMode,
      bookName,
      displayDate,
      request,
      RequestState,
    }
  },
}
</script>
<style lang="scss" scoped>
.vertical {
  writing-mode: vertical-lr;
}
.ocr-text {
  width: 100%;
  height: 100%;
}
</style>
