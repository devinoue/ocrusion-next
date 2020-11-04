<template>
  <section>
    <div
      class="w-full mx-auto max-w-2xl m-4 p-10 p-8 text-gray-700 bg-white rounded shadow-xl"
    >
      <!-- <p class="text-gray-800 font-medium">ログイン</p> -->
      <div class="pt-4">
        <label class="block text-sm text-gray-600">
          <span class="hidden">メールアドレス</span>
        </label>
        <input
          v-model="email"
          class="w-full p-3 text-gray-700 bg-gray-200 focus:outline-none focus:shadow-outline focus:border-blue-300 rounded"
          type="text"
          placeholder="メールアドレス"
          aria-label="Email"
        />
        <p v-if="errorEmail" class="mt-2 text-red-400 error-text text-sm">
          {{ errorEmail }}
        </p>
      </div>

      <div class="mt-6">
        <label class="block text-sm text-gray-600">
          <span class="hidden">パスワード</span>
        </label>
        <input
          v-model="password"
          class="w-full p-3 text-gray-700 bg-gray-200 focus:outline-none focus:shadow-outline focus:border-blue-300 rounded"
          type="password"
          placeholder="パスワード"
          aria-label="Password"
        />
        <p v-if="errorPassword" class="mt-2 text-red-400 error-text text-sm">
          {{ errorPassword }}
        </p>
      </div>
      <!--
      <div class="mt-2">
        <label class="inline-block text-sm text-gray-600" for="remember">
          ログイン時のデータを覚えさせる
        </label>
        <input
          id="remember"
          v-model="remember"
          class="text-teal-500 rowCheckbox px-5 py-1 form-checkbox focus:outline-none focus:shadow-outline"
          type="checkbox"
          required
        />
      </div> -->

      <div class="mt-6">
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
      email: '',
      password: '',
      remember: false,
    })
    const formsError = reactive({
      errorEmail: '',
      errorPassword: '',
    })

    const completedCondition = computed(() => {
      formsError.errorEmail = ''
      formsError.errorPassword = ''
      try {
        if (forms.email && forms.email.match(/.+@.+\..+/) === null) {
          formsError.errorEmail =
            'Eメールアドレスのフォーマットに従って入力してください'
          throw new Error(
            'Eメールアドレスのフォーマットに従って入力してください'
          )
        }
        if (forms.password && forms.password.length < 6) {
          formsError.errorPassword = 'パスワードは6文字以上で登録してください。'
          throw new Error('Form Error')
        }
      } catch (e) {
        return false
      }

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
      ...toRefs(formsError),
      onLoginButtonPushed,
      completedCondition,
    }
  },
}
</script>
<style lang="scss" scoped>
.error-text::before {
  margin-top: -4px;
  display: inline-block;
  margin-right: 4px;
  content: '!';
  font-weight: 800;
  width: 16px;
  height: 16px;
  line-height: 16px;
  vertical-align: middle;
  text-align: center;
  border-radius: 50%;
  background: #fc8181;
  color: #fff;
  font-size: 11px;
}
</style>
