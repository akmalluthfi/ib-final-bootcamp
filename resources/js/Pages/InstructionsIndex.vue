<template>
  <MainLayout>
    <h1 class="fs-2 mt-4 mb-5 fw-normal text-black">3rd Party Instruction</h1>

    <div class="full-shadow rounded">
      <InstructionTab :active="isOpen" :tabs="tabs" @handleTab="handleTab" />
      <section class="px-4 py-4">
        <component v-bind:is="currentTabComponent"></component>
      </section>
    </div>
  </MainLayout>
</template>

<script>
import InstructionOpen from "../Components/InstructionIndexOpen.vue";
import InstructionCompleted from "../Components/InstructionIndexCompleted.vue";
import InstructionTab from "../Components/InstructionIndexTab.vue";

export default {
  components: {
    InstructionOpen,
    InstructionCompleted,
    InstructionTab,
  },
  data() {
    return {
      isOpen: true,
      tabs: ["Open", "Completed"],
    };
  },
  computed: {
    currentTabComponent: function () {
      return this.isOpen ? InstructionOpen : InstructionCompleted;
    },
  },
  beforeMount() {
    this.handleTab(this.$route.query.tab);
  },
  watch: {
    $route(to, from) {
      this.handleTab(to.query.tab);
    },
  },
  methods: {
    handleTab(tab = "open") {
      this.isOpen = tab === "open";
    },
  },
};
</script>

<style scoped>
.full-shadow {
  box-shadow: 0 0 0.5rem rgb(0 0 0 / 10%) !important;
}
</style>