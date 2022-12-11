<template>
  <MainLayout>
    <h1 class="fs-2 mt-4 mb-5 fw-normal text-black">3rd Party Instruction</h1>

    <div class="full-shadow rounded bg-white">
      <InstructionTab
        :active="isOpen"
        :tabs="tabs"
        @handleTab="handleTab"
        :value="search"
        @handleInputSearch="handleInputDebounced"
      />
      <section class="px-4 py-4">
        <component
          v-show="!isLoading"
          v-bind:is="currentTabComponent"
          :instructions="instructions.data"
          @fetch="getNextInstructions"
        ></component>

        <!-- isLoading -->
        <div class="text-center text-info" v-show="isLoading">
          <div class="spinner-border" role="status">
            <span class="visually-hidden">Loading...</span>
          </div>
        </div>
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
      search: "",
      isLoading: true,
      instructions: {
        data: [],
        page: {
          current: 1,
          last: 1,
        },
      },
    };
  },
  computed: {
    currentTabComponent: function () {
      return this.isOpen ? InstructionOpen : InstructionCompleted;
    },
    handleInputDebounced: function () {
      return _.debounce(this.handleInputSearch, 200);
    },
  },
  beforeMount() {
    this.handleTab(this.$route.query.tab);
  },
  watch: {
    $route(to, from) {
      this.handleTab(to.query.tab);
    },
    search() {
      this.getInitialInstructions();
    },
    isOpen() {
      this.getInitialInstructions();
    },
  },
  methods: {
    handleTab(tab = "open") {
      this.isOpen = tab === "open";
      this.search = "";
    },
    handleInputSearch(value) {
      this.search = value;
    },
    async getInitialInstructions() {
      // for after search, for after change tab, & first render
      this.isLoading = true;
      try {
        const response = await axios.get("/api/instructions", {
          params: {
            tab: this.isOpen ? "open" : "completed",
            search: this.search.length <= 0 ? null : this.search,
          },
        });
        this.isLoading = false;
        this.instructions.data = response.data.data;

        this.instructions.page.last = response.data.meta.last_page;
        this.instructions.page.current = response.data.meta.current_page;
      } catch (error) {
        this.isLoading = false;
        this.instructions.data = [];
      }
    },
    async getNextInstructions() {
      // for infinite scroll
      if (this.instructions.page.current >= this.instructions.page.last) return;

      this.instructions.page.current++;

      try {
        const response = await axios.get("/api/instructions", {
          params: {
            tab: this.isOpen ? "open" : "completed",
            search: this.search.length <= 0 ? null : this.search,
            page: this.instructions.page.current,
          },
        });
        this.instructions.data.push(...response.data.data);

        this.instructions.page.last = response.data.meta.last_page;
      } catch (error) {
        this.instructions.data = [];
      }

      console.log(this.instructions.page.last, this.instructions.page.current);
    },
  },
  mounted() {
    this.getInitialInstructions();
  },
};
</script>

<style scoped>
.full-shadow {
  box-shadow: 0 0 0.25rem rgb(0 0 0 / 10%) !important;
}
</style>