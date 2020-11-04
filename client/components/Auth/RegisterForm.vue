<template>
  <section>
    <div
      class="w-full mx-auto max-w-2xl m-4 p-10 text-gray-700 bg-white rounded shadow-xl"
    >
      <div class="pt-4">
        <label class="block text-sm text-gray-600">
          <span class="hidden">メールアドレス</span>
        </label>
        <input
          v-model="email"
          class="w-full p-3 text-gray-700 bg-gray-200 rounded"
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
          <span class="hidden">パスワード(6文字以上の半角英数字・記号)</span>
        </label>
        <input
          v-model="password"
          class="w-full p-3 text-gray-700 bg-gray-200 rounded"
          type="password"
          placeholder="パスワード"
          aria-label="Password"
        />
        <p v-if="errorPassword" class="mt-2 text-red-400 error-text text-sm">
          {{ errorPassword }}
        </p>
      </div>
      <div class="mt-6">
        <label class="block text-sm text-gray-600">
          <span class="hidden">もう一度同じパスワード(確認用)</span>
        </label>
        <input
          v-model="passwordConfirmation"
          class="w-full p-3 text-gray-700 bg-gray-200 rounded"
          type="password"
          placeholder="もう一度同じパスワード(確認用)"
          aria-label="Password_Confirmation"
        />
        <p
          v-if="errorPasswordConfirmation"
          class="mt-2 text-red-400 error-text text-sm"
        >
          {{ errorPasswordConfirmation }}
        </p>
      </div>

      <div class="mt-6">
        <AppLoadingButton
          initial-label="新規登録"
          completed-label="新規登録が完了しました"
          :is-confirm="completedCondition"
          @onClick="onRegisterButtonPushed"
        />
      </div>
    </div>
  </section>
</template>
<script lang="ts">
import { reactive, toRefs, SetupContext, computed } from 'nuxt-composition-api'
export default {
  name: 'RegisterForm',
  setup(_props: {}, { emit }: SetupContext) {
    const forms = reactive({
      email: '',
      password: '',
      passwordConfirmation: '',
    })
    const formsError = reactive({
      errorEmail: '',
      errorPassword: '',
      errorPasswordConfirmation: '',
    })
    const completedCondition = computed(() => {
      formsError.errorEmail = ''
      formsError.errorPasswordConfirmation = ''
      formsError.errorPassword = ''
      try {
        if (forms.email && forms.email.match(/.+@.+\..+/) === null) {
          formsError.errorEmail = '正しいEメールアドレスを入力してください'
          throw new Error('Form Error')
        }
        if (forms.password && forms.password.length < 6) {
          formsError.errorPassword = 'パスワードは6文字以上で登録してください。'
          throw new Error('Form Error')
        }
        if (
          forms.password &&
          forms.passwordConfirmation &&
          forms.password !== forms.passwordConfirmation
        ) {
          formsError.errorPasswordConfirmation =
            '異なるパスワードが入力されています'
          throw new Error('Form Error')
        }
      } catch (e) {
        return false
      }

      return !!forms.email && !!forms.password && !!forms.passwordConfirmation
    })
    const onRegisterButtonPushed = () => {
      if (forms.password !== forms.passwordConfirmation) {
        alert('パスワードが異なります。同じパスワードを入力してください。')
        return
      }

      const params = {
        name: 'name',
        email: forms.email,
        password: forms.password,
        passwordConfirmation: forms.passwordConfirmation,
      }
      emit('onRegisterButtonPushed', params)
    }
    return {
      ...toRefs(forms),
      ...toRefs(formsError),
      onRegisterButtonPushed,
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
