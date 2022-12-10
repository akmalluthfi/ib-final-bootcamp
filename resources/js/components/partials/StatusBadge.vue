<template>
  <td>
    <span
      v-if="status === 'Completed'"
      class="py-2 px-3 bg-success text-white rounded-pill fs-5"
      >Completed</span
    >
    <span
      v-if="status === 'Cancelled'"
      class="py-2 px-3 bg-danger text-white rounded-pill fs-5"
      >Cancelled</span
    >
    <span
      v-if="status === 'In Progress'"
      class="py-2 px-3 bg-muted text-primary rounded-pill fs-5"
      >In Progress</span
    >
    <span
      v-if="status === 'Draft'"
      class="py-2 px-3 bg-muted text-primary rounded-pill fs-5"
      ><font-awesome-icon icon="fa-solid fa-circle-info" />Draft</span
    >
  </td>
</template>
<script>
export default {
  props: {
    status: {
      type: String,
    },
  },
};
</script>