<template>
  <div id="overlay">
    <div class="cv-copy">
      <h2>{{ leading }}</h2>
      <p>{{ comment }}</p>
    </div>
    <div class="cv-spinner">
      <span class="spinner"></span>
    </div>
  </div>
</template>
<script lang="ts">
import { ref } from 'nuxt-composition-api'
export default {
  name: '',
  props: {
    leading: {
      type: String,
      default: '',
      required: false,
    },
    comment: {
      type: String,
      default: 'ブラウザを閉じないでください',
      required: false,
    },
  },
  setup() {
    return {}
  },
}
</script>
<style lang="scss" scoped>
/********************************************
* Now Loading ref: https://pinkmonky.net/detail/?id=100
********************************************/
#overlay {
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
  position: fixed;
  top: 0;
  left: 0;
  z-index: 999;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.6);
}
.cv-copy {
  z-index: 9999;
  position: absolute;
  width: 100%;
  margin-top: 35vh;
  text-align: center;
}
.cv-copy h2 {
  color: #fff;
  font-size: 1.5em;
  margin-block-start: 0.83em;
  margin-block-end: 0.83em;
  margin-inline-start: 0;
  margin-inline-end: 0;
  font-weight: bold;
}
.cv-copy p {
  color: #fff;
}
.cv-spinner {
  height: 100%;
  display: flex;
  justify-content: center;
  align-items: center;
}
.spinner {
  width: 80px;
  height: 80px;
  border: 4px #ddd solid;
  border-top: 4px #999 solid;
  border-radius: 50%;
  animation: sp-anime 0.8s infinite linear;
}
@keyframes sp-anime {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(359deg);
  }
}
</style>
