<template>
  <section>
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
            <th scope="col">Invoice</th>
            <th class="text-center" scope="col">Customer PO</th>
            <th class="text-center" scope="col">Status</th>
          </tr>
        </thead>
        <tbody v-if="instructions.length">
          <tr
            v-for="instruction in instructions"
            :key="instruction.id"
            class="text-nowrap"
          >
            <td>{{ instruction.no }}</td>
            <td>{{ instruction.link_to }}</td>
            <td class="text-center">
              <fa
                icon="fa-truck"
                class="me-2"
                style="color: var(--bs-secondary)"
              />
              {{ instruction.type }}
            </td>
            <td>{{ instruction.assigned_vendor }}</td>
            <td>{{ instruction.attention_of }}</td>
            <td>{{ instruction.quotation_no }}</td>
            <td class="no-effect">
              <span class="badge rounded-circle text-bg-info text-white">{{
                instruction.vendor_invoices.count
              }}</span>
              <InvoiceDropdown
                :count="instruction.vendor_invoices.count"
                :invoices="
                  instruction.vendor_invoices.data.filter(
                    (invoice) => invoice.attachment
                  )
                "
              />
            </td>
            <td>{{ instruction.customer_po_no }}</td>
            <td class="no-effect">
              <span
                class="badge rounded-pill"
                :class="badgeClass(instruction.status)"
              >
                {{ instruction.status }}
                <button
                  v-show="instruction.status === 'Cancelled'"
                  class="
                    btn btn-primary
                    align-baseline
                    position-absolute
                    rounded-circle
                  "
                  style="
                    padding: 0 5px;
                    top: 3px;
                    right: 4px;
                    line-height: 16px;
                  "
                >
                  <code class="text-white">i</code>
                </button>
              </span>
            </td>
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
import InvoiceDropdown from "./InvoiceDropdown.vue";

export default {
  components: {
    InvoiceDropdown,
  },
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
        "position-relative": status === "Cancelled",
      };
    },
  },
};
</script>