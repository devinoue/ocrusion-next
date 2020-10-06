<template>
  <section>
    <div
      class="w-full mx-auto max-w-2xl m-4 p-10 text-gray-700 bg-white rounded shadow-xl"
    >
      <!-- <p class="text-gray-800 font-medium">新規登録</p> -->
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
      <div class="">
        <label class="block text-sm text-gray-600">
          パスワード(6文字以上の半角英数字・記号)
        </label>
        <input
          v-model="password"
          class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded"
          type="password"
          placeholder="パスワード"
          aria-label="Password"
        />
      </div>
      <div class="">
        <label class="block text-sm text-gray-600">
          確認のためもう一度パスワード
        </label>
        <input
          v-model="passwordConfirmation"
          class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded"
          type="password"
          placeholder="確認のためもう一度同じパスワードを入力してください"
          aria-label="Password_Confirmation"
        />
      </div>

      <div class="mt-4">
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

    const completedCondition = computed(() => {
      return !!forms.email && !!forms.password && !!forms.passwordConfirmation
    })
    const onRegisterButtonPushed = () => {
      if (forms.password !== forms.passwordConfirmation) {
        alert('パスワードが異なります。同じパスワードを入力してください。')
        return
      }
      if (forms.password.length < 6) {
        alert('パスワードは6文字以上で登録してください。')
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
      onRegisterButtonPushed,
      completedCondition,
    }
  },
}
</script>
<style lang="scss" scoped></style>
