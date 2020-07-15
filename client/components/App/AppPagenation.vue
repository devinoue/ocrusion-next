<template>
  <ul class="pagination">
    <PaginationLeftArror />
    <li class="page-item" :class="currentPage === 1 ? 'disable' : ''">
      <a :href="path + 'page=1'"> « </a>
    </li>
    <li class="page-item" :class="currentPage === 1 ? 'disable' : ''">
      <a :href="prevPageUrl"> 前へ </a>
    </li>
    <li v-for="page in pageNumbers" :key="page" class="page-item">
      <a
        :class="page === currentPage ? 'active' : ''"
        :href="path + 'page=' + page"
        >{{ page }}</a
      >
    </li>
    <li class="page-item" :class="currentPage === 1 ? 'disable' : ''">
      <a :href="nextPageUrl"> 次へ </a>
    </li>
    <li class="page-item" :class="currentPage === lastPage ? 'disable' : ''">
      <a :href="path + 'page=' + lastPage"> » </a>
    </li>
  </ul>
</template>
<script lang="ts">
import { defineComponent } from 'nuxt-composition-api'
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
    const to = props.bookData.to
    const lastPage = props.bookData.last_page
    const nextPageUrl = props.bookData.next_page_url
    const path = props.bookData.path
    const prevPageUrl = props.bookData.prev_page_url
    const perPage = props.bookData.per_page
    const total = props.bookData.total
    const firstPageUrl = props.bookData.first_page_url

    const pageNumbers = [...Array(props.last_page).keys()].map(
      (i: number) => ++i
    )
    return {
      currentPage,
      pageNumbers,
      from,
      to,
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
