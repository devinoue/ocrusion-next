<template>
  <section class="flex flex-col min-h-screen">
    <OrganismHeader :links="links" />
    <div class="flex-auto flex flex-wrap bg-white">
      <MoleculeBanner class="w-full md:w-3/4 text-center md:text-left" />
      <div class="container mx-auto px-4 py-8 md:py-16">
        <OrganismGrid :cards="cards" />
      </div>
    </div>
    <OrganismFooter
      :column-one-links="columnOneLinks"
      :column-two-links="columnTwoLinks"
    />
  </section>
</template>
<script lang="ts">
import { ref } from 'nuxt-composition-api'
import OrganismHeader from '../components/Organism/TheHeader.vue'

import OrganismFooter from '../components/Organism/TheFooter.vue'
import MoleculeBanner from '../components/Molecule/MoleculeBanner.vue'
import OrganismGrid from '../components/Organism/TheGrid.vue'

export default {
  name: 'Template',
  components: {
    MoleculeBanner,
    OrganismHeader,
    OrganismFooter,
    OrganismGrid,
  },
  setup() {
    const links = [{ name: 'Header link 1', url: '#' }]
    const cards = [
      {
        title: 'Card 1',
        text: 'Sed gravida libero sem, sed ornare arcu venenatis at.',
      },
    ]
    const columnOneLinks = [
      { name: 'Footer column 1', url: '#' },
      { name: 'Footer column 1', url: '#' },
    ]
    const columnTwoLinks = [
      { name: 'Footer column 2', url: '#' },
      { name: 'Footer column 2', url: '#' },
    ]
    return { columnTwoLinks, columnOneLinks, cards, links }
  },
}
</script>
<style lang="scss" scoped></style>
