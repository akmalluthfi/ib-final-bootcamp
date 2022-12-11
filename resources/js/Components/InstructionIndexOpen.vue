<template>
  <section>
    <div class="text-end mb-4">
      <button class="btn btn-info text-white">
        <fa icon="fa-plus" />
        Create 3rd Party Instruction
      </button>
    </div>

    <!-- tabel -->
    <div class="table-responsive">
      <table class="table table-hover table-sm">
        <thead>
          <tr class="bg-secondary text-white text-nowrap">
            <th scope="col">Instruction ID</th>
            <th scope="col">Link to</th>
            <th scope="col">Instruction Type</th>
            <th scope="col">Assigned Vendor</th>
            <th scope="col">Attention of</th>
            <th scope="col">Quotation No.</th>
            <th scope="col">Customer PO</th>
            <th scope="col">Status</th>
          </tr>
        </thead>
        <tbody v-if="instructions.length">
          <tr
            v-for="instruction in instructions"
            :key="instruction.id"
            class="text-nowrap"
            @click="getDetail(instruction.id)"
          >
            <th>{{ instruction.no }}</th>
            <th>{{ instruction.link_to }}</th>
            <th>{{ instruction.type }}</th>
            <th>{{ instruction.assigned_vendor }}</th>
            <th>{{ instruction.attention_of }}</th>
            <th>{{ instruction.quotation_no }}</th>
            <th>{{ instruction.customer_po_no }}</th>
            <th>{{ instruction.status }}</th>
          </tr>

          <div v-observe-visibility="handleScrolledToBottom"></div>
        </tbody>
        <tbody v-else>
          <tr>
            <td class="text-center text-warning py-5" colspan="8">
              <h5>Instruction Not Found</h5>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </section>
</template>

<script>
export default {
  props: {
    instructions: Array,
  },
  methods: {
    getDetail(id) {
      console.log(id);
    },
    handleScrolledToBottom(isVisible) {
      if (!isVisible) return;

      this.$emit("fetch");
    },
  },
};
</script>