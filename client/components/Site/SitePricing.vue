<template>
  <section>
    <div class="max-w-6xl mx-auto py-24 px-6">
      <div class="max-w-full md:max-w-6xl mx-auto my-3 md:px-8">
        <div
          class="relative flex flex-col md:flex-row items-center pricing-text"
        >
          <SitePricingColumn
            plan-name="プレミアムプラン"
            price="500"
            description="一日最大500MBアップロード可能！"
            :sub-des="[
              'セットアップ不要',
              'テキスト編集保存可能',
              'サービス追加',
            ]"
          />
          <SitePricingMainColumn
            plan-name="無料プラン"
            price="0"
            description="一日最大50MBアップロード可能！"
            :sub-des="['セットアップ不要', '一日最大50MB', 'テキスト出力']"
          />
          <SitePricingColumn
            plan-name="企業・研究室向けプラン"
            price="20,000～"
            description="一日最大500MBアップロード可能！"
            :sub-des="[
              'テキスト編集可能',
              '容量無限',
              'オーダーメイドサービス可能',
            ]"
          />
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
<style lang="scss" scoped>
.pricing-text {
  font-family: 'Hiragino Kaku Gothic Pro', 'メイリオ', 'ＭＳ Ｐゴシック',
    sans-serif;
}
</style>
