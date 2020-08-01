<template>
  <button
    class="gradient-button focus:outline-none focus:shadow-outline font-semibold px-6 py-2 text-white tracking-wider bg-gray-900 rounded initial"
  >
    {{ label }}
  </button>
</template>
<script lang="ts">
import { ref, defineComponent } from 'nuxt-composition-api'
export default defineComponent({
  name: '',
  props: {
    label: {
      type: String,
      required: false,
      default: 'button',
    },
  },
  setup() {
    return {}
  },
})
</script>
<style lang="scss" scoped>
.gradient-button {
  transition: 0.4s;
  background-size: 180% auto;
}
.initial {
  pointer-events: auto;
  display: inline-block;
  opacity: 1;
  background-image: linear-gradient(
    217deg,
    #26a699d0 0%,
    hsl(165, 63%, 53%) 40%,
    #26a699d0 100%
  );
  box-shadow: 0 10px 20px rgba(25, 196, 179, 0.384);
  &:hover {
    background-position: right center;
    box-shadow: 0 5px 5px rgba(25, 196, 179, 0.384);
  }
  &:active {
    filter: blur(20px);
  }
}
</style>
