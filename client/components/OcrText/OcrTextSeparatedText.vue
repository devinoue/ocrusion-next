<template>
  <div>
    <textarea v-model="separatedText" style="width: 900px; height: 400px;" />
  </div>
</template>

<script>
export default {
  props: ['separatedText'],
}
</script>

<style scoped></style>
