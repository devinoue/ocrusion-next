<template>
  <footer class="flex justify-center px-4 text-gray-100 bg-gray-800">
    <div class="container py-6">
      <div class="flex flex-col items-center justify-between mt-6 md:flex-row">
        <div>
          <a href="#" class="text-xl font-bold">
            <img
              src="~/static/white-logo.png"
              class="white-logo w-1/2 md:w-1/3"
              alt="white logo"
            />
          </a>
        </div>
        <div class="flex mt-4 md:m-0">
          <div class="mx-4">
            <nuxt-link to="/policies/tos" class="px-4 text-sm truncate"
              >利用規約</nuxt-link
            >
          </div>
          <div class="mx-4">
            <nuxt-link to="/policies/privacy" class="px-4 text-sm truncate"
              >プライバシーポリシー</nuxt-link
            >
          </div>
          <div class="mx-4">
            <a
              href="https://docs.google.com/forms/d/e/1FAIpQLScucDvr1yBURD9l8SHIttG8jEaYPaDhb4z0LVxlwYy2ZtJQWw/viewform"
              class="px-4 text-sm truncate"
              >Contact</a
            >
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
