<template>
  <div>
    <AppFullScreenLoading
      v-if="request.state === RequestState.LOADING"
      leading="アップロード中..."
      comment="Uploading..."
    />
    <AppLeading title="UPLOAD" sub-title="アップロード" class="text-center" />
    <UploadCapacity :capacity="capacity" class="text-center" />
    <UploadForm :status="status" @uploadParams="uploadParams" />

    <button large @click.stop="batch()">
      バッチ実行
    </button>
  </div>
</template>

<script lang="ts">
import { ref, onMounted } from '@vue/composition-api'
import axios from 'axios'
import { RequestState } from '~/types'
import useLoading from '~/composables/use-loading'

export default {
  name: 'Upload',
  layout: 'member',
  setup(_props: {}) {
    const { changeLoaded, changeLoading, changeFailure, request } = useLoading()
    const capacity = ref(0)
    onMounted(async () => {
      try {
        const res2 = await axios.get(
          'http://localhost:8080/api/capacities/3OfY3rPywDtU749NjsuynhiyOS9mjbRZPw4i'
        )
        capacity.value = res2.data.capacity
      } catch (e) {
        console.log(e.response)
      }
    })
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
      capacity,
      request,
      RequestState,
    }
  },
}
</script>

<style scoped lang="scss"></style>
