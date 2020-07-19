<template>
  <div>
    <div>
      <OcrTextSeparator
        class="shadow w-full"
        @changeSeparator="changeSeparator"
      />
      <button class="shadow" @click="onDownloadButtonClicked">
        テキストファイルをダウンロードする
      </button>
    </div>
    <br />
    <div v-for="ocr in ocrTexts" :key="ocr.img_path" class="my-6">
      <!-- eslint-disable-next-line vue/no-v-html -->
      <div v-html="formatOcrText(ocr.text_data)"></div>
    </div>
  </div>
</template>
<script lang="ts">
import sanitizeHTML from 'sanitize-html'

import { ref, defineComponent } from 'nuxt-composition-api'
export default defineComponent({
  name: '',
  props: {
    ocrTexts: {
      type: Array,
      reuired: true,
      default: [],
    },
  },
  setup(props: { ocrTexts: Array<any> }) {
    const changeSeparator = (value: string) => {
      separator.value = value
    }

    const formatOcrText = (ocrText: string) => {
      const ocr = ocrText + '<br />' + separator.value

      return sanitizeHTML(ocr.replace(/\n/g, '<br />\n'), {
        allowedTags: ['br'],
      })
    }

    const onDownloadButtonClicked = () => {
      const separatedOcrText = props.ocrTexts.reduce(
        // eslint-disable-next-line camelcase
        (acc, { text_data }) => acc + text_data + '\n' + separator.value + '\n',
        ''
      )
      console.log(separatedOcrText)
      const fileName = `text.txt`
      const blob = new Blob([separatedOcrText], { type: 'text/plain' })
      const link = document.createElement('a')
      link.href = window.URL.createObjectURL(blob)
      link.download = fileName
      link.click()
    }
    const separator = ref('────────────────────────────────────────────────')
    return {
      formatOcrText,
      separator,
      changeSeparator,
      onDownloadButtonClicked,
    }
  },
})
</script>
<style lang="scss" scoped></style>
