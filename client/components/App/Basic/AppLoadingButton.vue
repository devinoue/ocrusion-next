<template>
  <button
    class="focus:outline-none focus:shadow-outline transition duration-500 font-semibold px-6 py-2 shadow-good text-white tracking-wider bg-gray-900 hover:shadow-none rounded"
    :class="statusClass"
    @click.stop="onClick"
  >
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
import useLoading, { request } from '~/composables/use-loading'
type Props = {
  initialLabel: string
  completedLabel: string
  failureLabel: string
  isConfirm: boolean
}
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
    isConfirm: {
      type: Boolean,
      required: false,
      default: true,
    },
    failureLabel: {
      type: String,
      required: false,
      default: 'Failure',
    },
  },
  setup(props: Props, { emit }: SetupContext) {
    const { changeUninitialized } = useLoading()
    const loadingClass = computed(() => {
      if (request.state === RequestState.LOADING) {
        return 'sbl-circ'
      }
    })
    const onClick = () => {
      emit('onClick')
    }

    const label = ref(props.initialLabel)
    const statusClass = ref('initial')
    if (!props.isConfirm) {
      statusClass.value = 'loading'
    }
    watch(
      () => props.isConfirm,
      () => {
        if (!props.isConfirm) {
          statusClass.value = 'loading'
        } else if (props.isConfirm) {
          statusClass.value = 'initial'
        }
      }
    )
    watch(
      () => request.state,
      () => {
        if (request.state === RequestState.UNINITIALIZED) {
          label.value = props.initialLabel
          statusClass.value = 'initial'
        } else if (request.state === RequestState.LOADING) {
          label.value = 'Loading...'
          statusClass.value = 'loading'
        } else if (request.state === RequestState.LOADED) {
          label.value = props.completedLabel
          setTimeout(() => {
            statusClass.value = 'loaded'
            label.value = props.initialLabel
            changeUninitialized()
          }, 3000)
        } else if (request.state === RequestState.FAILURE) {
          label.value = props.failureLabel
          setTimeout(() => {
            statusClass.value = 'loaded'
            label.value = props.initialLabel
            changeUninitialized()
          }, 3000)
        }
      }
    )

    return { label, loadingClass, statusClass, onClick, request }
  },
})
</script>
<style lang="scss" scoped>
.initial {
  pointer-events: auto;
  opacity: 1;
  background: #26a69a;
  box-shadow: 0 10px 20px rgba(38, 166, 154, 0.2);
  &:hover {
    box-shadow: none;
  }
}
.loading {
  opacity: 0.4;
  cursor: not-allowed;
  pointer-events: none;
  background-color: #1a202c;
  box-shadow: 0 10px 20px rgba(49, 49, 49, 0.2);
}
.loaded {
  opacity: 1;
  cursor: not-allowed;
  pointer-events: none;
  background: #26a69a;
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
