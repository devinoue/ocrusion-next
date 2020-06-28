<template>
  <a :href="link.url">{{ link.name }}</a>
</template>
<script lang="ts">
export default {
  name: 'AtomLink',
  props: ['link'],
}
</script>
