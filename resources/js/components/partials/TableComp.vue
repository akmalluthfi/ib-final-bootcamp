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
        <th class="fw-bolder fs-4" scope="col">Invoice</th>
        <th class="fw-bolder fs-4" scope="col">Customer PO</th>
        <th class="fw-bolder fs-4" scope="col">Status</th>
      </tr>
    </thead>
    <tbody v-for="(item, index) in instructions" :key="index">
      <tr>
        <th scope="row" class="hidden"></th>
        <td>{{ item.no }}</td>
        <td>TRF-2022-0141</td>
        <td class="text-center">
          <font-awesome-icon icon="fa-solid fa-truck" class="text-muted" />
          {{ item.type }}
        </td>
        <td>{{ item.assigned_vendor }}</td>
        <td>{{ item.attention_of }}</td>
        <td>{{ item.quotation_no }}</td>
        <td>
          <span class="py-2 px-3 bg-info text-white rounded-circle">1</span>
        </td>
        <td>{{ item.customer_po_no }}</td>
        <td v-switch="item.status">
          <span
            v-case="'Completed'"
            class="py-2 px-3 bg-success text-white rounded-pill fs-5"
            >Completed</span
          >
          <span
            v-case="'Cancelled'"
            class="py-2 px-3 bg-danger text-white rounded-pill fs-5"
            >Cancelled</span
          >
          <span
            v-case="'In Progress'"
            class="py-2 px-3 bg-muted text-primary rounded-pill fs-5"
            >In Progress</span
          >
          <span
            v-case="'Draft'"
            class="py-2 px-3 bg-muted text-primary rounded-pill fs-5"
            ><font-awesome-icon icon="fa-solid fa-circle-info" />Draft</span
          >
          <span
            v-default
            class="py-2 px-3 bg-warning text-white rounded-pill fs-5"
            >Unknown</span
          >
        </td>
      </tr>
    </tbody>
  </table>
</template>

<script>
import { vSwitch, vCase, vDefault } from "v-switch-case";

export default {
  mounted() {},
  directives: {
    switch: vSwitch,
    case: vCase,
    default: vDefault,
  },
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

