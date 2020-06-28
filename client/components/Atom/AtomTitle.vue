<template>
  <component :is="tag" class="text-3xl font-serif pb-2">
    {{ content }}
  </component>
</template>
<script lang="ts">
export default {
  name: 'AtomTitle',
  props: ['tag', 'content'],
}
</script>
