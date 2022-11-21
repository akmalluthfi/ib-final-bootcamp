<template>
  <table class="table table-success table-hover fs-5">
    <thead>
      <tr>
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
    <tbody
      class="cursor-pointer"
      v-for="(item, index) in instructions"
      :key="index"
    >
      <tr>
        <th scope="row" class="hidden"></th>
        <td>LI-2022-0003</td>
        <td>TRF-2022-0141</td>
        <td>
          <font-awesome-icon icon="fa-solid fa-truck" class="text-muted" />
          LI
        </td>
        <td>{{ item.assigned_vendor }}</td>
        <td>{{ item.attention_of }}</td>
        <td>{{ item.quotation_no }}</td>
        <td>
          <span class="py-2 px-3 bg-info text-white rounded-circle">1</span>
        </td>
        <td>Otto</td>
        <td v-switch="item.status">
          <span
            v-case="'completed'"
            class="py-2 px-3 bg-success text-white rounded-pill"
            >Completed</span
          >
          <span
            v-case="'cancelled'"
            class="py-2 px-3 bg-warning text-white rounded-pill"
            >Cancelled</span
          >
          <span
            v-case="'In Progress'"
            class="py-2 px-3 bg-info text-white rounded-pill"
            >In Progress</span
          >
          <span v-default class="py-2 px-3 bg-warning text-white rounded-pill"
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
  mounted() {
    console.log(this.instructions);
  },
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
</style>