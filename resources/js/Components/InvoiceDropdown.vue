<template>
  <div class="dropdown d-inline">
    <button
      class="btn btn-link dropdown-toggle text-secondary py-0 px-1"
      type="button"
      data-bs-toggle="dropdown"
      aria-expanded="false"
    ></button>
    <ul class="dropdown-menu" v-if="invoices.length">
      <li v-for="invoice in invoices" :key="invoice._id">
        <a class="dropdown-item" href="#">{{ invoice.attachment }}</a>
      </li>
    </ul>
    <ul class="dropdown-menu" style="cursor: default" v-else>
      <li class="text-center">No Attachments</li>
    </ul>
  </div>
</template>

<script>
export default {
  props: {
    count: Number,
    invoices: Array || null,
  },
};
</script>