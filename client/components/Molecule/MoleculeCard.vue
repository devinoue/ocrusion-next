<template>
  <div
    class="p-6 border border-blue-200 hover:shadow-lg rounded-sm bg-blue-100 text-blue-800 transition ease-in-out duration-500"
  >
    <AtomTitle tag="h2" :content="card.title" />
    <AtomText :text="card.text" />
  </div>
</template>

<script>
import AtomTitle from '~/components/Atom/AtomTitle.vue'
import AtomText from '~/components/Atom/AtomText.vue'

export default {
  name: 'MoleculeCard',
  components: {
    AtomTitle,
    AtomText,
  },
  props: ['card'],
}
</script>
