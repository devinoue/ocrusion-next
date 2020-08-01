require('dotenv').config()
console.info('nuxt.config.js MESSAGE:', process.env.API_KEY)
export default {
  /*
   ** Nuxt rendering mode
   ** See https://nuxtjs.org/api/configuration-mode
   */
  mode: 'spa',
  /*
   ** Headers of the page
   ** See https://nuxtjs.org/api/configuration-head
   */
  head: {
    titleTemplate: '%s | 自炊OCRアプリ',
    meta: [
      { charset: 'utf-8' },
      { name: 'viewport', content: 'width=device-width, initial-scale=1' },
      {
        hid: 'description',
        name: 'description',
        content:
          '自炊した本をまとめて日本語OCRしたい。その時はぜひ自炊OCRアプリをご利用ください。簡単操作であっという間にOCRが完了。すぐにテキスト形式でデータを入手できます。まずは無料版を体験してください。',
      },
      {
        hid: 'og:description',
        property: 'og:description',
        content:
          '自炊した本のOCRを楽にしたい。そういうときは自炊OCRアプリをご利用ください。シンプルな操作ですぐに変換。簡単にテキストデータに変換してくれます。まずは無料版からお試しください。',
      },
      { hid: 'og:url', property: 'og:type', content: 'https://example.com' },
      {
        hid: 'og:image',
        property: 'og:image',
        content: 'OGPイメージのファイルパス',
      },
    ],
    link: [
      { rel: 'icon', type: 'image/png', href: '/favicon.png' },
      {
        rel: 'apple-touch-icon',
        size: '180x180',
        href: '/apple-touch-icon.png',
      },
    ],
  },
  /*
   ** Global CSS
   */
  css: [
    '~/assets/css/test.scss',
    '~/assets/css/ui.scss',
    '~/assets/css/animate.min.css',
  ],
  /*
   ** Plugins to load before mounting the App
   ** https://nuxtjs.org/guide/plugins
   */
  plugins: [
    '~/plugins/axios',
    { src: '@/plugins/localStorage', ssr: false },
    { src: '~plugins/nuxt-client-init.js', ssr: false },
  ],
  /*
   ** Nuxt.js dev-modules
   */
  buildModules: [
    '@nuxt/typescript-build',
    // Doc: https://github.com/nuxt-community/stylelint-module
    '@nuxtjs/stylelint-module',
    // Doc: https://github.com/nuxt-community/nuxt-tailwindcss
    '@nuxtjs/tailwindcss',
    'nuxt-composition-api',
  ],
  dotenv: {
    path: process.cwd(),
  },
  components: true,
  /*
   ** Nuxt.js modules
   */
  modules: [
    '@nuxtjs/dotenv',
    '@nuxtjs/style-resources',
    ['vue-scrollto/nuxt', { duration: 700 }],
  ],
  /*
   ** Build configuration
   ** See https://nuxtjs.org/api/configuration-build/
   */
  build: {},
}
