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

    // infinite scroll methods
    getNextInstructions() {
      window.onscroll = () => {
        let bottomOfWindow =
          Math.ceil(document.documentElement.scrollTop + window.innerHeight) >=
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
        }
      };
    }
  },
  mounted() {
    this.getNextInstructions();
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
