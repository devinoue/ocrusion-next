<template>
  <footer class="flex justify-center px-4 text-gray-100 bg-gray-800">
    <div class="container py-6">
      <h1 class="text-center text-lg font-bold lg:text-2xl">
        紙の本を、すべてデジタル化しませんか？<br />
        今すぐ簡単にはじめられます。
      </h1>

      <hr class="h-px mt-6 bg-gray-700 border-none" />

      <div class="flex flex-col items-center justify-between mt-6 md:flex-row">
        <div>
          <a href="#" class="text-xl font-bold">
            <!-- <img
              src="~/static/white-logo.png"
              class="white-logo"
              alt="white logo"
          />
          -->
          </a>
        </div>
        <div class="flex mt-4 md:m-0">
          <div class="-mx-4">
            <a href="#" class="px-4 text-sm">Contact</a>
          </div>
        </div>
      </div>
    </div>
  </footer>
</template>
<script lang="ts">
import { ref } from 'nuxt-composition-api'
export default {
  name: '',
  setup() {
    return {}
  },
}
</script>
<style lang="scss" scoped>
.white-logo {
  box-sizing: border-box;
  width: 50%;
}
.footer-li {
  &::before {
    content: '';
    position: absolute;
    display: inline-block;
    top: 50%;
    left: 10px;
    width: 0.6em;
    height: 0.6em;
    transform: rotate(45deg) translate(-0.2em, -0.2em);
    border-top: 2px solid #0a3557;
    border-right: 2px solid #0a3557;
  }
}
</style>
