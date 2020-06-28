<template>
  <div class="flex flex-wrap items-stretch md:-mr-4">
    <div
      v-for="card in cards"
      :key="card.name"
      class="w-full md:w-1/3 md:pr-4 pb-4"
    >
      <MoleculeCard class="h-full" :card="card" />
    </div>
  </div>
</template>

<script>
import MoleculeCard from '~/components/Molecule/MoleculeCard.vue'

export default {
  name: 'OrganismGrid',
  components: {
    MoleculeCard,
  },
  props: ['cards'],
}
</script>
