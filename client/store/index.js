import Cookies from 'js-cookie'
import createPersistedState from 'vuex-persistedstate'
export const actions = {
  nuxtServerInit({ commit }, { req }) {
    const token = cookieFromRequest(req, 'token')
    if (token) {
      commit('Auth/SET_TOKEN', token)
    }
  },

  nuxtClientInit({ commit }) {
    createPersistedState()(this)
    const token = Cookies.get('token')
    if (token) {
      commit('Auth/SET_TOKEN', token)
    }
  },
}

/**
 * Get cookie from request.
 *
 * @param  {Object} req
 * @param  {String} key
 * @return {String|undefined}
 */
export function cookieFromRequest(req, key) {
  if (!req.headers.cookie) {
    return
  }

  const cookie = req.headers.cookie
    .split(';')
    .find((c) => c.trim().startsWith(`${key}=`))

  if (cookie) {
    return cookie.split('=')[1]
  }
}
