<template>
  <div class="cnetering-container text-center">
    <h1 class="error-title">{{ error.statusCode }}</h1>
    <p v-if="error.statusCode === 404" class="error-txt">
      ページが見つかりません
    </p>
    <p v-else class="error-txt">エラーが発生しました</p>
    <nuxt-link class="error-link" to="/">ホーム</nuxt-link>
  </div>
</template>

<script lang="ts">
export default {
  props: ['error'],
}
</script>

<style lang="scss" scoped>
.cnetering-container {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
}
.error {
  text-align: center;
  padding: 20px;
  &-title {
    font-size: 4rem;
    font-weight: bold;
  }
}
</style>
