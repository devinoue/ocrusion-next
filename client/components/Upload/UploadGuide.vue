<template>
  <div>
    <ul class="p__upload-guide text-sm py-3">
      <li v-for="guide in guides" :key="guide" class="pl-4 flex items-center">
        <svg class="h2 w-2 text-teal-500 mx-2" viewBox="0 0 8 8" fill="#cfcfcf">
          <circle cx="4" cy="4" r="3" />
        </svg>
        {{ guide }}
      </li>
      <li class="pl-4 flex items-center">
        <svg class="h2 w-2 text-teal-500 mx-2" viewBox="0 0 8 8" fill="#cfcfcf">
          <circle cx="4" cy="4" r="3" />
        </svg>
        その他、<nuxt-link to="/policies/privacy" class="font-semibold"
          >プライバシーポリシー</nuxt-link
        >と<nuxt-link to="/policies/tos" class="font-semibold"
          >利用規約</nuxt-link
        >も必ず御覧ください。
      </li>
    </ul>
  </div>
</template>
<script lang="ts">
import { ref } from 'nuxt-composition-api'
export default {
  name: '',
  setup() {
    const guides = [
      'jpeg または png 形式の画像をZIP圧縮してください。',
      'ファイル名は半角英数字と_-といった記号が使用可能です(日本語は使用不可)。',
      '違法ファイルをアップロードしないでください。',
      '1ファイル300KB以下が理想的です。',
      'ルビが多い本、段組の本はうまくテキスト化できません。',
      'アップロードした画像ファイルは一週間で削除されます。ご了承ください。',
      'OCR出力されたデータは、日本の法令に基づいて適切にご利用ください。',
    ]
    return { guides }
  },
}
</script>
<style lang="scss" scoped>
.point__guide {
  position: relative;
  font-size: 12px;
}
.p__upload-guide {
  //
}
.tooltip .tooltip-text {
  visibility: hidden;
  text-align: center;
  padding: 2px 6px;
  position: absolute;
  z-index: 100;
}
.tooltip:hover .tooltip-text {
  visibility: visible;
}
</style>
