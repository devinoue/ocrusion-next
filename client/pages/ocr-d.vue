<template>
  <div>
    <button @click="batch">button</button>
  </div>
</template>
<script lang="ts">
import { ref } from 'nuxt-composition-api'
import axios from 'axios'
export default {
  name: '',
  setup() {
    const batch = async () => {
      const url = `/api/book/delete/k1V4qW8r4k8Ik8p5`
      const params = {
        imgPaths: ['000d2.jpg', '0001.jpg'],
      }
      try {
        const baseApi = axios.create({ baseURL: 'http://localhost:8080' })
        const res = await baseApi.post(url, params)
        console.log(res)
      } catch (e) {
        console.log(e.response)
      }
    }
    return {
      batch,
    }
  },
}
</script>
<style lang="scss" scoped></style>
