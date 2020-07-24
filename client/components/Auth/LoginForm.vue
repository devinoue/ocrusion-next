<template>
  <section>
    <div
      class="w-full mx-auto max-w-2xl m-4 p-10 p-8 text-gray-700 bg-white rounded shadow-xl"
    >
      <p class="text-gray-800 font-medium">ログイン</p>
      <div class="">
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

      <div class="">
        <label class="block text-sm text-gray-600">
          パスワード
        </label>
        <input
          v-model="password"
          class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded"
          type="password"
          placeholder="パスワード"
          aria-label="Password"
        />
      </div>
      <div class="mt-2">
        <label class="inline-block text-sm text-gray-600" for="remember">
          ログイン時のデータを覚えさせる
        </label>
        <input
          id="remember"
          v-model="remember"
          class="px-5 py-1 text-gray-700 bg-gray-200 rounded"
          type="checkbox"
          required
        />
      </div>

      <div class="mt-4">
        <AppLoadingButton
          initial-label="ログイン"
          completed-label="無事ログインが完了しました"
          :is-confirm="completedCondition"
          @onClick="onLoginButtonPushed"
        />
      </div>
    </div>
  </section>
</template>
<script lang="ts">
import { reactive, toRefs, SetupContext, computed } from 'nuxt-composition-api'
export default {
  name: 'LoginForm',
  setup(_props: {}, { emit }: SetupContext) {
    const forms = reactive({
      email: 'bb@ko.com',
      password: 'hogehoge',
      remember: false,
    })

    const completedCondition = computed(() => {
      return !!forms.email && !!forms.password
    })
    const onLoginButtonPushed = () => {
      const params = {
        email: forms.email,
        password: forms.password,
        remember: forms.remember,
      }
      emit('onLoginButtonPushed', params)
    }

    return {
      ...toRefs(forms),
      onLoginButtonPushed,
      completedCondition,
    }
  },
}
</script>
<style lang="scss" scoped></style>
