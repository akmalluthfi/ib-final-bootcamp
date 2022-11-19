<template>
  <div :class="column">
    <label for="" class="form-control-label">{{ label }}</label>
    <input
      type="text"
      class="form-control"
      :placeholder="placeholder"
      required
    />
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
  },
};
</script>

<style>
</style>