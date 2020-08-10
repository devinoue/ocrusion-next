<template>
  <div>
    <AppFullScreenLoading
      v-if="request.state === RequestState.LOADING"
      leading="アップロード中..."
      comment="Uploading..."
    />
    <AppLeading title="UPLOAD" sub-title="アップロード" class="text-center" />
    <UploadCapacity :capacity="capacity" class="text-center" />
    <UploadForm @uploadParams="uploadParams" />

    <!-- 
    <button large @click.stop="batch()">
      バッチ実行
    </button> -->
  </div>
</template>

<script lang="ts">
import { ref, onMounted, SetupContext } from '@vue/composition-api'
import axios from 'axios'
import { RequestState } from '~/types'
import useLoading from '~/composables/use-loading'

export default {
  name: 'Upload',
  layout: 'member',
  head: {
    title: 'アップロード',
  },
  setup(_props: {}, { root }: SetupContext) {
    const userId = root.$store.getters['Auth/user'].id
    const {
      changeLoaded,
      changeLoading,
      changeFailure,
      request,
      changeUninitialized,
    } = useLoading()
    const capacity = ref(0)
    onMounted(async () => {
      changeUninitialized()
      try {
        const res2 = await axios.get(`/api/capacities/${userId}`)
        capacity.value = res2.data.capacity
      } catch (e) {
        alert(`${e.message}`)
      }
    })
    const batch = async () => {
      const url = `/api/batch`
      try {
        await axios.get(url)
      } catch (e) {
        alert(`${e.message}`)
      }
    }

    const uploadParams = async (params: any) => {
      changeLoading()
      const url = `/api/files/${userId}`

      const headers = { 'content-type': `multipart/form-data` }
      try {
        await axios.post(url, params, {
          headers,
        })
        changeLoaded()
        root.$router.push('/members/dashboard')
      } catch (e) {
        // e.responseが空ならおそらく起動していない
        alert(`${e.message}`)
        changeFailure()
      }
    }

    return {
      batch,
      uploadParams,
      changeLoaded,
      capacity,
      request,
      RequestState,
    }
  },
}
</script>

<style scoped lang="scss"></style>
