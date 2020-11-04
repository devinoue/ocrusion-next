<template>
  <section class="container mx-auto py-24">
    <div class="flex flex-wrap">
      <div class="w-full lg:w-1/3 px-4">
        <div class="mb-8">
          <h4 class="font-bold mb-2 text-lg">
            無料トライアルはいつまでできますか？
          </h4>
          <p class="text-sm mb-3">
            無料ユーザーには試用期間はありません。基本的に毎日50MBずつアップロードが可能です。
          </p>
        </div>
      </div>
      <div class="w-full lg:w-1/3 px-4">
        <div class="mb-8">
          <h4 class="font-bold mb-2 text-lg">
            ダウンロードはできますか？
          </h4>
          <p class="text-sm mb-3">
            OCR化されたデータはテキストファイルでダウンロード可能です。
            テキストファイルのダウンロードに制限はありません。
          </p>
        </div>
      </div>
      <div class="w-full lg:w-1/3 px-4">
        <div class="mb-8">
          <h4 class="font-bold mb-2 text-lg">
            アップロードされた画像ファイルはいつまで使用できますか？
          </h4>
          <p class="text-sm mb-3">
            OCR成功後はアップロードされた画像ファイルは残りません。
            画像ファイルは保管されませんので、お客様ご自身による管理をお願いいたします。
          </p>
        </div>
      </div>
    </div>
    <div class="flex flex-wrap justify-center"></div>
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
