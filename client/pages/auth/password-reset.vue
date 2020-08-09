<template>
  <div class="pt-48">
    <section>
      <div
        class="w-full mx-auto max-w-2xl m-4 p-10 p-8 text-gray-700 bg-white rounded shadow-xl"
      >
        {{ message }}
        <div class="pt-4">
          <label class="block text-sm text-gray-600">
            メールアドレス
          </label>
          <input
            v-model="email"
            class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded"
            type="text"
            placeholder="メールアドレス"
            aria-label="Email"
          />
        </div>

        <div class="mt-4">
          <AppLoadingButton
            initial-label="メール送信"
            completed-label="無事メールが送信されました"
            :is-confirm="!!email"
            @onClick="onPushed"
          />
        </div>
      </div>
    </section>
  </div>
</template>
<script lang="ts">
import { ref } from 'nuxt-composition-api'
import axios from 'axios'
export default {
  name: '',
  layout: 'default',
  setup() {
    const email = ref('pasteur1822@gmail.com')
    const message = ref('')
    const onPushed = async () => {
      const data = {
        email: email.value,
      }
      try {
        await axios.post('http://localhost:8080/password/email', data)
        message.value = '送信しました。メールボックスをご確認ください。'
        email.value = ''
      } catch (e) {
        console.log(e)
        console.log(e.message)
        console.log(e.reponse)
      }
    }
    return {
      email,
      onPushed,
      message,
    }
  },
}
</script>
<style lang="scss" scoped></style>
