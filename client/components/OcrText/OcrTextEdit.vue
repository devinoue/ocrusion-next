<template>
  <div>
    <div v-for="ocrText in ocrTexts" :key="ocrText.book_id + ocrText.img_path">
      <button
        class="shadow"
        @click="onDeleteOcrTextClicked(ocrText.book_id, ocrText.img_path)"
      >
        削除する
      </button>
      <button
        class="shadow"
        @click="
          onEditButtonClicked(
            ocrText.book_id,
            ocrText.img_path,
            ocrText.text_data
          )
        "
      >
        編集を保存する
      </button>
      <textarea
        v-model="ocrText.text_data"
        class="resize form-textarea mt-1 block w-full shadow"
        :rows="changeRows(ocrText.text_data)"
      ></textarea>
    </div>
  </div>
</template>
<script lang="ts">
import { ref, PropType, computed } from 'nuxt-composition-api'
import axios from 'axios'
export default {
  name: '',
  props: {
    ocrTexts: {
      type: Array as PropType<any>,
      required: true,
      default: [],
    },
  },
  setup() {
    const onDeleteOcrTextClicked = async (bookId: string, imgPath: string) => {
      try {
        const params = { imgPaths: [imgPath] }
        const res = await axios.post(
          `http://localhost:8080/api/book/delete/${bookId}`,
          params
        )
        if (res.data?.message ?? null) {
          alert('正常に終了しました')
        }
        // 見た目の削除処理
      } catch (e) {
        console.log(e)
        console.log(e.response)
      }
    }
    const changeRows = (value: string) => {
      const num = value.split('\n').length
      return num > 4 ? num + 2 : 4
    }

    const onEditButtonClicked = async (
      bookId: string,
      imgPath: string,
      textData: string
    ) => {
      try {
        const params = { ocrTexts: [{ imgPath, textData }] }
        const res = await axios.post(
          `http://localhost:8080/api/book/${bookId}`,
          params
        )
        if (res.data?.message ?? null) {
          alert('正常に終了しました')
        }
        console.log(res.data)
      } catch (e) {
        console.log(e)
        console.log(e.response)
      }
    }
    return { onDeleteOcrTextClicked, onEditButtonClicked, changeRows }
  },
}
</script>
<style lang="scss" scoped>
.textarea-edit {
  width: 100%;
}
</style>
