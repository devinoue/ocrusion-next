<template>
  <div class="flex flex-col items-center my-12">
    <div class="flex text-gray-700">
      <nuxt-link :to="prevPage">
        <PaginationLeftArror />
      </nuxt-link>
      <div class="flex h-12 font-medium rounded-full bg-gray-200">
        <div
          v-for="page in pageNumbers"
          :key="page"
          :class="page === currentPage ? 'bg-teal-600 text-white' : ''"
          class="w-12 md:flex justify-center items-center hidden cursor-pointer leading-5 transition duration-150 ease-in rounded-full"
        >
          <nuxt-link :to="numberPage(page)">{{ page }}</nuxt-link>
        </div>
      </div>
      <nuxt-link :to="nextPage">
        <PaginationRightArrow />
      </nuxt-link>
    </div>
  </div>
</template>
<script lang="ts">
import { defineComponent, computed } from 'nuxt-composition-api'

const getPageNumberFromUrl = (url: string) => {
  const pattern = /[\d]*$/g

  const result: any = url.match(pattern)
  return result.length > 0 ? result[0] : null
}

export default defineComponent({
  name: '',
  props: {
    bookData: {
      type: Object,
    },
  },
  setup(props: any) {
    const currentPage = props.bookData.current_page
    const from = props.bookData.from
    const toto = props.bookData.to
    const lastPage = props.bookData.last_page
    const nextPageUrl = props.bookData.next_page_url
    const path = props.bookData.path
    const prevPageUrl = props.bookData.prev_page_url
    const perPage = props.bookData.per_page
    const total = props.bookData.total
    const firstPageUrl = props.bookData.first_page_url

    const pageNumbers = computed(() => {
      return [...Array(props.bookData.last_page).keys()].map((i: number) => ++i)
    })
    const numberPage = (page: number) => {
      if (!page) return '#'
      return `/members/dashboard/${page}`
    }
    const prevPage = computed(() => {
      if (!prevPageUrl) return '#'
      return currentPage === 1
        ? '#'
        : `/members/dashboard/${getPageNumberFromUrl(prevPageUrl)}`
    })
    const nextPage = computed(() => {
      if (!nextPageUrl) return '#'
      return currentPage === toto
        ? '#'
        : `/members/dashboard/${getPageNumberFromUrl(nextPageUrl)}`
    })

    return {
      prevPage,
      nextPage,
      numberPage,
      currentPage,
      pageNumbers,
      from,
      toto,
      lastPage,
      nextPageUrl,
      path,
      prevPageUrl,
      perPage,
      total,
      firstPageUrl,
    }
  },
})
</script>
<style lang="scss" scoped>
ul.pagination {
  display: inline-block;
  padding: 0;
  margin: 0;
}
ul.pagination li {
  display: inline;
}
ul.pagination li a {
  transition: background-color 0.3s;
  margin: 0 4px; /* 0 is for top and bottom. Feel free to change it */
  border: 1px solid #ddd; /* Gray */
  padding: 5px;
}
ul.pagination li a.active {
  background-color: #4caf50;
  color: white;
  border-radius: 5px;
}
ul.pagination li a:hover:not(.active) {
  background-color: #ddd;
  border-radius: 5px;
}
</style>
