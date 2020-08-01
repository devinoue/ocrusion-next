<template>
  <section class="bg-white border-b py-24">
    <div class="container max-w-5xl mx-auto m-8">
      <div class="flex flex-wrap">
        <div class="w-5/6 sm:w-1/2 p-6">
          <h3 class="text-3xl text-gray-800 font-bold leading-none mb-3">
            AIで縦書きの日本語小説をテキストに
          </h3>
          <p class="text-gray-600 mb-8 leading-normal">
            高性能なAIにより縦書きの読み込みも高い正確性で読み取り可能です。<br />
            小説、専門書など長くて重たい内容の本も、テキストであれば読みやすく修正を
          </p>
        </div>
        <div class="w-full sm:w-1/2 p-6">
          <SiteIllustB />
        </div>
      </div>

      <div class="flex flex-wrap flex-col-reverse sm:flex-row">
        <div class="w-full sm:w-1/2 p-6 mt-6">
          <SiteIllustA />
        </div>
        <div class="w-full sm:w-1/2 p-6 mt-6">
          <div class="align-middle">
            <h3 class="text-3xl text-gray-800 font-bold leading-none mb-3">
              ZIPファイルでまとめてアップロードするだけ
            </h3>
            <p class="text-gray-600 mb-8 leading-normal">
              スキャンされた本の画像をご用意してください。
              あとはそれをZIP形式にしてアップロードするだけ。
              しばらく待てばテキストデータとしてアカウントに保管されます。
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>
<script lang="ts">
import { ref } from 'nuxt-composition-api'
export default {
  name: '',
  setup() {
    return {}
  },
}
</script>
<style lang="scss" scoped></style>
