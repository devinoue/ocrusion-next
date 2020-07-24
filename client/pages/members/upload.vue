<template>
  <div>
    <AppLeading title="UPLOAD" sub-title="アップロード" class="text-center" />
    <UploadForm :status="status" @uploadParams="uploadParams" />

    <button large @click.stop="batch()">
      バッチ実行
    </button>
  </div>
</template>

<script lang="ts">
import { ref } from '@vue/composition-api'
import axios from 'axios'
import { RequestState } from '~/types'
import useLoading from '~/composables/use-loading'

export default {
  name: 'Upload',
  layout: 'member',
  setup(_props: {}) {
    const { changeLoaded, changeLoading, changeFailure } = useLoading()

    const batch = async () => {
      const url = `/api/batch`
      try {
        const baseApi = axios.create({ baseURL: 'http://localhost:8080' })
        const res = await baseApi.get(url)
        console.log(res)
      } catch (e) {
        console.log(e.response)
      }
    }
    const status = ref(RequestState.UNINITIALIZED)
    const uploadParams = async (params: any) => {
      changeLoading()
      const url = `/api/files/${params.userId}`
      console.log(url)
      const headers = { 'content-type': `multipart/form-data` }
      try {
        const baseApi = axios.create({ baseURL: 'http://localhost:8080' })
        const res = await baseApi.post(url, params, {
          headers,
        })
        console.log(res)
        changeLoaded()
      } catch (e) {
        // e.responseが空ならおそらく起動していない
        console.log(e.response)
        changeFailure()
      }
    }

    return {
      batch,
      uploadParams,
      status,
      changeLoaded,
    }
  },
}
</script>

<style scoped lang="scss"></style>
