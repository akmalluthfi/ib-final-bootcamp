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
export default {
  data() {
    return {
      instructions: null,
    };
  },

  async created() {
    const response = await axios.get("http://127.0.0.1:8000/api/instructions");
    this.instructions = response.data.data;
    console.log(response.data.data);
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
