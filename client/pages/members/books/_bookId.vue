<template>
  <div class="container mx-auto">
    <div class="my-6">
      <AppLeading
        :title="'BOOK LIST'"
        :sub-title="'本一覧'"
        class="text-center"
      />
    </div>
    <section v-if="mode === 'display'">
      <button class="shadow" @click="changeMode">編集モードへ</button>
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
import { ref, onMounted, SetupContext } from 'nuxt-composition-api'
import axios from 'axios'

export default {
  name: '',
  layout: 'member',
  setup(_props: {}, ctx: SetupContext) {
    console.log()
    const bookId = ctx.root.$route.params?.bookId ?? null
    const mode = ref<'edit' | 'display'>('display')
    if (bookId === null) {
      //
    }
    const ocrTexts = ref<any>([])
    const changeMode = () => {
      return mode.value === 'edit'
        ? (mode.value = 'display')
        : (mode.value = 'edit')
    }
    onMounted(async () => {
      try {
        const baseApi = axios.create({ baseURL: 'http://localhost:8080' })
        const result = await baseApi.get(`/api/book/${bookId}`)
        ocrTexts.value = result.data.ocrTexts
      } catch (e) {
        alert(`${e.message}`)
      }
    })
    return { ocrTexts, mode, changeMode }
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
