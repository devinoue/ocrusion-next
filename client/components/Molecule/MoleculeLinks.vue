<template>
  <ul>
    <li v-for="(link, index) in links" :key="link.name + index">
      <AtomLink :link="link" />
    </li>
  </ul>
</template>

<script>
import AtomLink from '~/components/Atom/AtomLink.vue'

export default {
  name: 'MoleculeLinks',
  components: {
    AtomLink,
  },
  props: ['links'],
}
</script>
