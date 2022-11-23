<template>
  <div>
    <navbar></navbar>
    <div class="container-fluid mt-5">
      <h2>3rd Party Instruction</h2>
      <p>
        Vendor Management
        <span class="text-success">> 3rd Party Instruction</span>
      </p>
      <div class="card mt-4">
        <div class="card-body">
          <Tabs setActive="completed"></Tabs>
        </div>
      </div>
      <table-comp
        v-if="!!instructions"
        :instructions="instructions"
      ></table-comp>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      instructions: null,
      limit: 10,
    };
  },

  methods: {
    getInitialInstructions() {
      axios
        .get("/api/instructions?tab=completed")
        .then((response) => {
          this.instructions = response.data.data;
          this.limit = limit + 1;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    getNextInstruction() {
      window.onscroll = () => {
        let bottomOfWindow =
          document.documentElement.scrollTop + window.innerHeight ===
          document.documentElement.offsetHeight;
        if (bottomOfWindow) {
          axios.get(`/api/instructions?limit=${this.page}`).then((response) => {
            this.instructions = this.instructions.concat(response.data.data);
          });
        }
      };
    },
  },
  mounted() {
    this.getInitialInstructions();
  },
  beforeMount() {
    this.getInitialInstructions();
  },
};
</script>
<style>
a {
  color: rgb(34, 34, 34) !important;
}

.active {
  color: cyan !important;
  border-bottom: 3px solid cyan !important;
}
</style>
