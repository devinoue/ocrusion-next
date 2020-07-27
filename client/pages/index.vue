<template>
  <div>
    <AppLoadingButton
      initial-label="ダウンロード"
      completed-label="成功しました"
      :status="status"
      @onClick="onClick()"
    />
    <nuxt-link to="/test">fffff</nuxt-link>
    <button @click="onClick()">fff</button>
  </div>
</template>

<script lang="ts">
import { ref, onMounted, SetupContext } from '@vue/composition-api'
import axios from 'axios'
import useLoading from '../composables/use-loading'
export default {
  name: 'Login',
  layout: 'default',
  setup(_props: {}, { root }: SetupContext) {
    const list2 = ref([])
    console.log(root.$store.getters['Auth/token'])
    root.$store.commit('Auth/SET_TOKEN', 'fffhffff')
    console.log(root.$store.getters['Auth/token'])
    const status = ref('UNINITIALIZED')
    const error = ref(null)
    const onClick = async () => {
      axios
        .get(
          'http://localhost:8080/api/capacities/3OfY3rPywDtU749NjsuynhiyOS9mjbRZPw4i'
        )
        .then((res) => {
          console.log(res.data.message)
        })
        .catch((e) => {
          console.log(e)
          console.log(e.response)
        })
    }

    return {
      list2,
      error,
      status,
      onClick,
    }
  },
}
</script>

<style></style>
