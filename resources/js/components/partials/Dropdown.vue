<template>
  <div :class="column">
    <label for="" class="form-control-label">{{ label }}</label>
    <select
      class="form-control selectpicker"
      id="select-vendor"
      data-live-search="true"
      required
    >
      <option disabled selected hidden>{{ placeholder }}</option>
      <option data-tokens="china">China</option>
      <option data-tokens="malayasia">Malayasia</option>
      <option data-tokens="singapore">Singapore</option>
      <option v-if="addNew === true">
        <button
          type="button"
          class="btn btn-outline-success"
          data-toggle="modal"
          data-target="#exampleModal"
        >
          <i class="fa fa-plus" aria-hidden="true"></i>
          Add New Invoice
        </button>
      </option>
    </select>
  </div>
</template>

<script>
export default {
  props: {
    label: {
      type: String,
    },
    placeholder: {
      type: String,
    },
    column: {
      type: String,
    },
    addNew: {
      type: Boolean,
      default: false,
    },
  },
  mounted() {},
};
</script>

<style>
</style>