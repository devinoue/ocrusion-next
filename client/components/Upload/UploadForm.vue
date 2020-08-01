<template>
  <section>
    <div
      class="w-full mx-auto max-w-2xl m-4 p-10 text-gray-700 bg-white rounded shadow-xl"
    >
      <p class="text-gray-800 font-medium">アップロードの詳細</p>
      <div class="">
        <label class="block text-sm text-gray-600">
          本の名前(空欄可)
        </label>
        <input
          v-model="bookName"
          class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded"
          type="text"
          placeholder="無題"
          aria-label="Name"
        />
      </div>
      <div class="mt-2">
        <label class="block text-sm text-gray-600">
          説明(空欄可)
        </label>
        <textarea
          v-model="description"
          class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded"
        ></textarea>
      </div>

      <div class="mt-2">
        <label class="block text-sm text-gray-600" for="cus_email">
          画像アップロード
        </label>

        <div
          :class="['dropzone-area', dragging ? 'dropzone-over' : '']"
          drag-over="handleDragOver"
          @dragenter="dragging = true"
          @dragleave="dragging = false"
        >
          <div class="dropzone-text">
            <div class="dropzone-title">
              ここに画像を圧縮したZIPファイルをD&Dしてください。
              <br />
              <b>ファイル名は、必ず半角英数字に変更しておいてください。</b>
            </div>
            <span v-if="file">
              アップロードするファイル : {{ file.name }}
            </span>
          </div>
          <input
            name="upfile"
            type="file"
            multiple="multiple"
            @change="onDrop"
          />
        </div>
      </div>

      <div class="mt-2">
        <label class="inline-block text-sm text-gray-600" for="up_confirm">
          注意事項を了承する
        </label>
        <input
          id="up_confirm"
          v-model="isConfirm"
          class="px-5 py-1 text-gray-700 bg-gray-200 rounded"
          type="checkbox"
          required
        />
      </div>
      <div class="mt-4">
        <AppLoadingButton
          initial-label="アップロードする"
          completed-label="無事アップロードされました"
          :is-confirm="completedCondition"
          @onClick="uploadParams"
        />
      </div>
    </div>
  </section>
</template>
<script lang="ts">
import { reactive, SetupContext, computed, toRefs } from 'nuxt-composition-api'

import { RequestState } from '~/types'

export default {
  name: '',

  setup(_props: {}, { root, emit }: SetupContext) {
    const defaultForms = {
      userId: root.$store.getters['Auth/user'].id,
      file: null as any,
      message: '',
      dragging: false,
      isSuccess: false,
      isConfirm: false,
      bookName: '',
      description: '',
      bookOptions: '{}',
    }

    const forms = reactive(defaultForms)

    const completedCondition = computed(() => {
      return !!forms.file && forms.isConfirm
    })

    // ファイル選択で選んだファイルを取得する
    const onDrop = (event: any) => {
      if (event?.target?.files.length > 0) {
        forms.file = event.target.files[0]
      } else if (event?.dataTransfer?.files.length > 0) {
        forms.file = event.dataTransfer.files[0]
      }
    }

    const uploadParams = () => {
      if (forms.file === '') {
        alert('ファイルがセットされていません。')
        return
      }

      if (forms.bookName === '') {
        forms.bookName = '無題'
      }

      const params = new FormData()
      params.append('bookName', forms.bookName)
      params.append('description', forms.description)
      params.append('bookOptions', forms.bookOptions)
      params.append('user_id', forms.userId)
      params.append('upfile', forms.file)

      emit('uploadParams', params)
      // リフレッシュ
    }

    return {
      uploadParams,
      ...toRefs(forms),
      onDrop,
      completedCondition,
    }
  },
}
</script>
<style lang="scss" scoped>
.drop {
  width: 100%;
  height: 200px;
  position: relative;
  border: 2px dashed #cbcbcb;
}

.drop:hover {
  border: 2px dashed #249e92;
}

.drop input {
  position: absolute;
  cursor: pointer;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  width: 100%;
  height: 100%;
  opacity: 0;
}
.dropzone-over {
  border: 1px solid greenyellow !important;
}

.dropzone-title {
  font-size: 16px;
  color: #787878;
  letter-spacing: 0.4px;
}
.dropzone-area {
  height: 200px;
  position: relative;
  border: 2px dashed #cbcbcb;
  &:hover {
    border: 2px dashed #2e94c4;
    .dropzone-title {
      color: #1975a0;
    }
  }
}

.dropzone-area input {
  position: absolute;
  cursor: pointer;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  width: 100%;
  height: 100%;
  opacity: 0;
}

.dropzone-text {
  position: absolute;
  top: 50%;
  text-align: center;
  transform: translate(0, -50%);
  width: 100%;
  span {
    line-height: 1.9;
  }
}
</style>
