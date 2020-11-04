<template>
  <button
    class="gradient-button focus:outline-none focus:shadow-outline font-semibold p-3 text-white tracking-wider bg-gray-900 rounded w-full"
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
  addingClass: string[]
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
    addingClass: {
      type: Array,
      required: false,
      default: Array,
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
    const addingClass = () => {
      return props.addingClass.length > 0 ? props.addingClass : []
    }
    const label = ref(props.initialLabel)
    const statusClass = ref(['initial', ...addingClass()])
    if (!props.isConfirm) {
      statusClass.value = ['loading', ...addingClass()]
    }
    watch(
      () => props.isConfirm,
      () => {
        if (!props.isConfirm) {
          statusClass.value = ['loading', ...addingClass()]
        } else if (props.isConfirm) {
          statusClass.value = ['initial', ...addingClass()]
        }
      }
    )

    watch(
      () => request.state,
      () => {
        if (request.state === RequestState.UNINITIALIZED) {
          label.value = props.initialLabel
          statusClass.value = ['initial', ...addingClass()]
        } else if (request.state === RequestState.LOADING) {
          label.value = 'Loading...'
          statusClass.value = ['loading', ...addingClass()]
        } else if (request.state === RequestState.LOADED) {
          label.value = props.completedLabel
          setTimeout(() => {
            statusClass.value = ['loaded', ...addingClass()]
            label.value = props.initialLabel
            changeUninitialized()
          }, 3000)
        } else if (request.state === RequestState.FAILURE) {
          label.value = props.failureLabel
          setTimeout(() => {
            statusClass.value = ['loaded', ...addingClass()]
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
.gradient-button {
  transition: 0.4s;
  // transition: all 0.5s cubic-bezier(0.25, 0.8, 0.25, 1);
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

.loading {
  opacity: 0.4;
  cursor: not-allowed;
  pointer-events: none;
  background-color: #1a202c;
  box-shadow: 0 20px 20px rgba(27, 27, 27, 0.438);
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
