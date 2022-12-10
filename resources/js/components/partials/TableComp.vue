<template>
  <table class="table fs-4">
    <thead>
      <tr class="bg-secondary text-white">
        <th scope="col" class="hidden"></th>
        <th class="fw-bolder fs-4" scope="col">Instruction ID</th>
        <th class="fw-bolder fs-4" scope="col">Link To</th>
        <th class="fw-bolder fs-4" scope="col">Instruction Type</th>
        <th class="fw-bolder fs-4" scope="col">Assigned Vendor</th>
        <th class="fw-bolder fs-4" scope="col">Attention Of</th>
        <th class="fw-bolder fs-4" scope="col">Quotation No.</th>

        <th
          v-if="instructions[0].vendor_invoices !== undefined"
          class="fw-bolder fs-4"
          scope="col"
        >
          Invoice
        </th>

        <th class="fw-bolder fs-4" scope="col">Customer PO</th>
        <th class="fw-bolder fs-4" scope="col">Status</th>
      </tr>
    </thead>
    <tbody v-for="(item, index) in instructions" :key="index">
      <tr>
        <th scope="row" class="hidden"></th>
        <td>
          <router-link
            :to="{
              name: 'Details',
              params: { id: item.id },
            }"
            class="text-decoration-none"
            :disabled="true"
          >
            {{ item.no }}
          </router-link>
        </td>
        <td>
          <router-link
            :to="{
              name: 'Details',
              params: { id: item.id },
            }"
            class="text-decoration-none"
            :disabled="true"
          >
            {{ item.link_to }}
          </router-link>
        </td>
        <td class="text-center">
          <router-link
            :to="{
              name: 'Details',
              params: { id: item.id },
            }"
            class="text-decoration-none ms-auto"
            :disabled="true"
          >
            <font-awesome-icon icon="fa-solid fa-truck" class="text-muted" />
            {{ item.type }}
          </router-link>
        </td>
        <td>
          <router-link
            :to="{
              name: 'Details',
              params: { id: item.id },
            }"
            class="text-decoration-none"
            :disabled="true"
          >
            {{ item.assigned_vendor }}
          </router-link>
        </td>
        <td>
          <router-link
            :to="{
              name: 'Details',
              params: { id: item.id },
            }"
            class="text-decoration-none"
            :disabled="true"
          >
            {{ item.attention_of }}
          </router-link>
        </td>
        <td>
          <router-link
            :to="{
              name: 'Details',
              params: { id: item.id },
            }"
            class="text-decoration-none"
            :disabled="true"
          >
            {{ item.quotation_no }}
          </router-link>
        </td>
        <td v-if="item.vendor_invoices !== undefined">
          <router-link
            :to="{
              name: 'Details',
              params: { id: item.id },
            }"
            class="text-decoration-none"
            :disabled="true"
          >
            <span class="py-2 px-3 bg-info text-white rounded-circle">
              {{ item.vendor_invoices.count }}
            </span>
          </router-link>
        </td>
        <td>
          <router-link
            :to="{
              name: 'Details',
              params: { id: item.id },
            }"
            class="text-decoration-none"
            :disabled="true"
          >
            {{ item.customer_po_no }}
          </router-link>
        </td>
        <router-link
          :to="{
            name: 'Details',
            params: { id: item.id },
          }"
          class="text-decoration-none mt-5"
          :disabled="true"
        >
          <status-badge :status="item.status" />
        </router-link>
      </tr>
    </tbody>
  </table>
</template>

<script>
import StatusBadge from "./StatusBadge.vue";
export default {
  components: { StatusBadge },
  mounted() {},
  props: {
    instructions: {
      type: Array,
    },
  },
};
</script>
<style>
tr:hover {
  color: aqua;
  cursor: pointer;
}
.bg-muted {
  background-color: #dddddd !important;
}
</style>

