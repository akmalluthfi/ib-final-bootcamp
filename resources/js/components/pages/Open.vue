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
          <Tabs setActive="open"></Tabs>
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
import axios from "axios";
export default {
  data() {
    return {
      instructions: null,
      page: 1,
      lastPage: null,
    };
  },

  methods: {
    // infinite scroll methods
    getInitialInstructions() {
      axios
        .get("/api/instructions?tab=open&page=1")
        .then((response) => {
          this.instructions = response.data.data;
          this.page = this.page + 1;
          this.lastPage = response.data.meta.last_page;
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
          if (this.page > this.lastPage) {
            return;
          }
          axios
            .get(`/api/instructions?tab=open&page=${this.page}`)
            .then((response) => {
              this.instructions = this.instructions.concat(response.data.data);
              this.page = this.page + 1;
            })
            .catch((error) => {
              console.log(error);
            });
        }
      };
    },
  },
  mounted() {
    this.getNextInstruction();
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
  color: #28a745 !important;
  border-bottom: 3px solid #28a745 !important;
}
</style>
