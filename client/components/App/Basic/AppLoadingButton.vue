<template>
  <button class="shadow" :class="statusClass" @click="onClick()">
    <div :class="loadingClass"></div>
    {{ label }}
  </button>
</template>
<script lang="ts">
import {
  defineComponent,
  watch,
  computed,
  SetupContext,
  ref,
} from 'nuxt-composition-api'
import { RequestState } from '~/types/index'

type Props = { initialLabel: string; status: string; completedLabel: string }
export default defineComponent({
  name: '',
  props: {
    initialLabel: {
      type: String,
      required: true,
      default: '',
    },
    completedLabel: {
      type: String,
      required: false,
      default: 'Completed!',
    },

    status: {
      type: String,
      required: true,
      default: RequestState.UNINITIALIZED,
    },
  },
  setup(props: Props, { emit }: SetupContext) {
    const loadingClass = computed(() => {
      if (props.status === RequestState.LOADING) {
        return 'sbl-circ'
      }
    })
    const onClick = () => {
      emit('onClick')
    }

    const label = ref(props.initialLabel)
    const statusClass = ref('initial')

    watch(
      () => props.status,
      () => {
        if (props.status === RequestState.UNINITIALIZED) {
          label.value = props.initialLabel
          statusClass.value = 'initial'
        } else if (props.status === RequestState.LOADING) {
          label.value = 'Loading...'
          statusClass.value = 'loading'
        } else if (props.status === RequestState.LOADED) {
          label.value = props.completedLabel
          setTimeout(() => {
            statusClass.value = 'loaded'
            label.value = props.initialLabel
          }, 3000)
        }
      }
    )

    return { label, loadingClass, statusClass, onClick }
  },
})
</script>
<style lang="scss" scoped>
.initial {
  pointer-events: auto;
  opacity: 1;
}
.loading {
  opacity: 0.4;
  cursor: not-allowed;
  pointer-events: none;
}
.loaded {
  opacity: 1;
  cursor: not-allowed;
  pointer-events: none;
}
// ref https://mdjunaidalam5.github.io/SpinBolt/
.sbl-circ {
  height: 1rem;
  width: 1rem;
  color: #5a5a5a;
  position: relative;
  display: inline-block;
  border: 2px solid;
  border-radius: 50%;
  border-top-color: transparent;
  animation: rotate 1s linear infinite;
}

@keyframes rotate {
  0% {
    transform: rotate(0);
  }
  100% {
    transform: rotate(360deg);
  }
}
</style>
