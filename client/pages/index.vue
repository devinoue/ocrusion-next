<template>
  <div class="container">
    <div>
      <h1 class="title">
        ocrusion
      </h1>
      <div class="links">
        <a
          href="https://nuxtjs.org/"
          target="_blank"
          rel="noopener noreferrer"
          class="button--green"
        >
          Documentation
        </a>
        <a
          href="https://github.com/nuxt/nuxt.js"
          target="_blank"
          rel="noopener noreferrer"
          class="button--grey"
        >
          GitHub
        </a>
      </div>
      {{ list2 }}
    </div>
  </div>
</template>

<script lang="ts">
import { ref, onMounted } from '@vue/composition-api'
import axios from 'axios'
export default {
  name: 'Login',
  setup() {
    const a = ref(process.env.API_KEY)
    const list2 = ref<any>({})

    onMounted(async () => {
      try {
        const res = await axios.get('http://localhost:8000/api/book')
        list2.value = res ?? {}
      } catch (e) {
        console.log(e.response)
      }
    })

    return {
      list2,
    }
  },
}
</script>

<style>
/* Sample `apply` at-rules with Tailwind CSS
.container {
@apply min-h-screen flex justify-center items-center text-center mx-auto;
}
*/
.container {
  margin: 0 auto;
  min-height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;
  text-align: center;
}

.title {
  font-family: 'Quicksand', 'Source Sans Pro', -apple-system, BlinkMacSystemFont,
    'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
  display: block;
  font-weight: 300;
  font-size: 100px;
  color: #35495e;
  letter-spacing: 1px;
}

.subtitle {
  font-weight: 300;
  font-size: 42px;
  color: #526488;
  word-spacing: 5px;
  padding-bottom: 15px;
}

.links {
  padding-top: 15px;
}
</style>
