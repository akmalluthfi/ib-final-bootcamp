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
      <table class="table table-hover table-instructions">
        <thead>
          <tr class="bg-secondary text-white text-nowrap">
            <th scope="col">Instruction ID</th>
            <th scope="col">Link to</th>
            <th scope="col">Instruction Type</th>
            <th scope="col">Assigned Vendor</th>
            <th scope="col">Attention of</th>
            <th scope="col">Quotation No.</th>
            <th class="text-center" scope="col">Customer PO</th>
            <th class="text-center" scope="col">Status</th>
          </tr>
        </thead>
        <tbody v-if="instructions.length">
          <tr
            v-for="instruction in instructions"
            :key="instruction.id"
            class="text-nowrap"
            @click="$emit('handleDetail', instruction.id)"
          >
            <th>{{ instruction.no }}</th>
            <th>{{ instruction.link_to }}</th>
            <th class="texx-center">
              <fa
                icon="fa-truck"
                class="me-2"
                style="color: var(--bs-secondary)"
              />
              {{ instruction.type }}
            </th>
            <th>{{ instruction.assigned_vendor }}</th>
            <th>{{ instruction.attention_of }}</th>
            <th>{{ instruction.quotation_no }}</th>
            <th>{{ instruction.customer_po_no }}</th>
            <th>
              <span
                class="badge rounded-pill"
                :class="badgeClass(instruction.status)"
              >
                {{ instruction.status }}
              </span>
            </th>
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
    handleScrolledToBottom(isVisible) {
      if (!isVisible) return;

      this.$emit("fetch");
    },
    badgeClass(status) {
      return {
        "in-progress": status === "In Progress",
        draft: status === "Draft",
        completed: status === "Completed",
        cancelled: status === "Cancelled",
      };
    },
  },
};
</script>