<template>
  <div>
    {{ message }}
    <span v-show="isSuccess">成功しました</span>

    <div
      :class="['dropzone-area', dragging ? 'dropzone-over' : '']"
      drag-over="handleDragOver"
      @dragenter="dragging = true"
      @dragleave="dragging = false"
    >
      <div class="dropzone-text">
        <span class="dropzone-title">
          ここに画像を圧縮したZIPファイルをドラッグ・アンド・ドロップしてください。
          <br />
          <b>ファイル名は、必ず半角英数字に変更しておいてください。</b>
          <br />
        </span>
        <span v-if="file">アップロードするファイル : {{ file.name }}</span>
      </div>

      <input
        id="upform"
        ref="upfile"
        name="upfile"
        type="file"
        multiple="multiple"
        @change="onDrop"
      />
    </div>
    書名: <input v-model="bookName" type="text" placeholder="無題" /><br />
    説明: <textarea v-model="description"></textarea><br />
    OCRデータを公開しますか？
    <input v-model="openType" type="checkbox" /><br />
    その他の情報 :
    <input v-model="bookOptions" type="text" /><br />

    注意事項を了承する<input v-model="isConfirm" type="checkbox" required />
    <br />
    <button class="" :disabled="!isConfirm" @click.stop="upload()">
      アップロードする
    </button>

    <button large @click.stop="batch()">
      バッチ実行
    </button>
  </div>
</template>

<script>
import { ref } from '@vue/composition-api'
import axios from 'axios'

export default {
  name: 'Upload',
  setup() {
    const userId = ref(1)
    const file = ref('')
    const message = ref('')
    const dragging = ref(false)
    const isSuccess = ref(false)
    const isConfirm = ref(true)

    const bookName = ref('本の名前が入る')
    const description = ref('説明')
    const openType = ref(1)
    const bookOptions = ref('')

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
    const upload = async () => {
      if (file.value === '') {
        alert('ファイルがセットされていません。')
        return
      }

      if (bookName.value === '') {
        bookName.value = '無題'
      }

      const params = new FormData()
      params.append('bookName', bookName.value)
      params.append('description', description.value)
      params.append('openType', openType.value)
      params.append('bookOptions', bookOptions.value)
      params.append('user_id', userId.value)
      params.append('upfile', file.value)

      const url = `/api/files/${userId.value}`
      console.log(url)
      const headers = { 'content-type': `multipart/form-data` }
      try {
        const baseApi = axios.create({ baseURL: 'http://localhost:8080' })
        const res = await baseApi.post(url, params, {
          headers,
        })
        console.log(res)
      } catch (e) {
        // e.responseが空ならおそらく起動していない
        console.log(e.response)
      }
    }
    // ファイル選択で選んだファイルを取得する
    const onDrop = (event) => {
      file.value = event.target.files[0]
        ? event.target.files[0]
        : event.dataTransfer.files[0]
    }

    return {
      userId,
      file,
      message,
      dragging,
      isSuccess,
      isConfirm,
      batch,
      upload,
      onDrop,
      bookName,
      description,
      openType,
      bookOptions,
    }
  },
}

//
// export default {
//   name: 'Upload',
//   data() {
//     return {
//       userId: 1,
//       loading: false,
//       file: null,
//       isSuccess: false,
//       res_message: '',
//       res_message_error: '',
//       dialog: false,
//       checkbox: true,
//       dragging: false,
//       error_flg: false,
//       form: new Form({
//         upfile: '',
//       }),
//     }
//   },
//   watch: {
//     async dialog(val) {
//       if (!val) {
//         return
//       }
//       this.res_message_error = ''
//       if (document.getElementById('upform').value === '') {
//         alert('ファイルが選択されていません')
//         this.dialog = false
//         return
//       }
//       const host = '/files/' + this.userId
//
//       const params = new FormData()
//       params.append('upfile', this.file)
//       const file = this.file
//       // Do some client side validation...
//       this.form.upfile = file
//       const url = `/api${host}`
//       console.log(url)
//       try {
//         const baseApi = axios.create({ baseURL: 'http://localhost:8000' })
//         const res = await baseApi
//           .post(url, params, {
//             headers: {
//               'Content-Type': 'multipart/form-data',
//             },
//           })
//           .catch((e) => {
//             console.error(e)
//           })
//         console.log(res)
//         return
//       } catch (e) {
//         console.log(e)
//       }
//     },
//   },
//   methods: {
//     async batch() {
//       const url = `/api/batch`
//       try {
//         const baseApi = axios.create({ baseURL: 'http://localhost:8000' })
//         const res = await baseApi.get(url)
//         console.log(res)
//       } catch (e) {
//         console.log(e.response)
//       }
//     },
//     async upload() {
//       const params = new FormData()
//       params.append('user_id', 1)
//       params.append('upfile', this.file)
//
//       const url = `/api/files/${this.userId}`
//       console.log(url)
//       const headers = { 'content-type': `multipart/form-data` }
//       try {
//         const baseApi = axios.create({ baseURL: 'http://localhost:8000' })
//         const res = await baseApi.post(url, params, {
//           headers,
//         })
//         console.log(res)
//       } catch (e) {
//         console.log(e.response)
//       }
//     },
//     // ファイル選択で選んだファイルを取得する
//     onDrop(event) {
//       this.file = event.target.files[0]
//         ? event.target.files[0]
//         : event.dataTransfer.files[0]
//     },
//   },
// }
</script>

<style scoped lang="scss">
.container {
  margin: 0 auto;
  min-height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;
  text-align: center;
}

.drop {
  width: 80%;
  height: 200px;
  position: relative;
  border: 2px dashed #cbcbcb;
}

.drop:hover {
  border: 2px dashed #2e94c4;
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
  width: 80%;
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
