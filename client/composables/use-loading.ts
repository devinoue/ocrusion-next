import { reactive, provide, InjectionKey } from '@vue/composition-api'
import { RequestState } from '~/types/index'
export const request = reactive<{
  state: any
}>({
  state: RequestState.UNINITIALIZED,
})
export default function useLoading() {
  const changeUninitialized = () => (request.state = RequestState.UNINITIALIZED)
  const changeLoading = () => (request.state = RequestState.LOADING)
  const changeLoaded = () => (request.state = RequestState.LOADED)
  const changeFailure = () => (request.state = RequestState.FAILURE)

  return {
    request,
    changeUninitialized,
    changeLoading,
    changeLoaded,
    changeFailure,
  }
}
export type LoadingStateType = ReturnType<typeof useLoading>
const LoadingKey: InjectionKey<LoadingStateType> = Symbol('LoadingStateType')
export const provideState = () => provide(LoadingKey, useLoading())
