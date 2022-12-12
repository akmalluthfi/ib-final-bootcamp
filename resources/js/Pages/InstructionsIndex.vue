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
          v-show="!isLoading || instructions.data.length"
          v-bind:is="currentTabComponent"
          :instructions="instructions.data"
          @fetch="getNextInstructions"
          @handleDetail="handleDetail"
        ></component>

        <!-- isLoading -->
        <div class="text-center text-info py-3" v-show="isLoading">
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
      this.instructions.data = [];
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
    handleDetail(id) {
      console.log(id);
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
        this.instructions.data = response.data.data;

        this.instructions.page.last = response.data.meta.last_page;
        this.instructions.page.current = response.data.meta.current_page;
      } catch (error) {
        console.error(error);
        this.instructions.data = [];
      }

      this.isLoading = false;
    },
    async getNextInstructions() {
      // for infinite scroll
      if (this.instructions.page.current >= this.instructions.page.last) return;

      this.instructions.page.current++;

      this.isLoading = true;
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
        console.error(error);
        this.instructions.data = [];
      }

      this.isLoading = false;
    },
  },
  mounted() {
    this.getInitialInstructions();
  },
};
</script>

<style>
.full-shadow {
  box-shadow: 0 0 0.25rem rgb(0 0 0 / 10%) !important;
}

.table-instructions > tbody * {
  font-weight: 400;
}

.table-instructions > tbody > tr:hover *:not(span) {
  color: var(--bs-info) !important;
  cursor: pointer;
}

.table-instructions .badge {
  padding: 0.5rem 1.25rem;
  background-color: var(--bs-body-color);
}

.table-instructions .badge.in-progress {
  background-color: #e2ebf9;
  color: #637ca0;
}

.table-instructions .badge.draft {
  background-color: #f5f6f8;
  color: #58595b;
}

.table-instructions .badge.completed {
  background-color: #00c060;
  color: #fff;
}

.table-instructions .badge.cancelled {
  background-color: #a6afb7;
  color: #fff;
}
</style>