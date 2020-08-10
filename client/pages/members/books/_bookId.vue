<template>
  <div class="container mx-auto">
    <AppFullScreenLoading
      v-if="request.state === RequestState.LOADING"
      leading="読み込み中..."
      comment=""
    />
    <div class="my-6">
      <AppBookLeading :title="''" :sub-title="bookName" class="text-center" />
    </div>
    <nuxt-link
      class="pl-6 font-semibold"
      to
      onclick="javascript:window.history.back(-1);return false;"
    >
      « ダッシュボードへ戻る
    </nuxt-link>
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
import { ref, onMounted, SetupContext, computed } from '@vue/composition-api'
import axios from 'axios'
import useLoading from '../../../composables/use-loading'
import { RequestState } from '../../../types/index'

export default {
  name: '',
  head: {
    title: '読書を楽しむなら自炊OCR',
  },
  layout: 'member',
  setup(_props: {}, ctx: SetupContext) {
    const userId = ctx.root.$store.getters['Auth/user'].id
    const {
      changeLoaded,
      changeLoading,
      changeFailure,
      request,
      changeUninitialized,
    } = useLoading()
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
      changeUninitialized()
      try {
        changeLoading()
        const result = await axios.get(`/api/book/${bookId}`)

        ocrTexts.value = result.data.ocrTexts
        bookDetails.value = result.data.imageDirs
        changeLoaded()
      } catch (e) {
        changeFailure()
        alert(`${e.message}`)
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
