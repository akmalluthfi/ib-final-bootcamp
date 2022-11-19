<template>
  <table class="table table-success table-hover fs-5">
    <thead>
      <tr>
        <th scope="col" class="hidden"></th>
        <th scope="col">Instruction ID</th>
        <th scope="col">Link To</th>
        <th scope="col">Instruction Type</th>
        <th scope="col">Assigned Vendor</th>
        <th scope="col">Attention Of</th>
        <th scope="col">Quotation No.</th>
        <th scope="col">Invoice</th>
        <th scope="col">Customer PO</th>
        <th scope="col">Status</th>
      </tr>
    </thead>
    <tbody class="cursor-pointer">
      <tr>
        <th scope="row" class="hidden"></th>
        <td>LI-2022-0003</td>
        <td>TRF-2022-0141</td>
        <td>
          <font-awesome-icon icon="fa-solid fa-truck" class="text-muted" />
          LI
        </td>
        <td>Centurion Transport</td>
        <td>Operations</td>
        <td></td>
        <td>
          <span class="py-2 px-3 bg-info text-white rounded-circle">1</span>
        </td>
        <td>Otto</td>
        <td v-switch="statusMsg">
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
            v-case="'progress'"
            class="py-2 px-3 bg-info text-white rounded-pill"
            >On Progress</span
          >
          <span v-default class="py-2 px-3 bg-info text-white rounded-pill"
            >On Progress</span
          >
        </td>
      </tr>
    </tbody>
  </table>
</template>

<script>
import { vSwitch, vCase, vDefault } from "v-switch-case";

export default {
  directives: {
    switch: vSwitch,
    case: vCase,
    default: vDefault,
  },
  props: {
    statusMsg: {
      type: String,
      default: "progress",
    },
  },
};
</script>

<style>
</style>