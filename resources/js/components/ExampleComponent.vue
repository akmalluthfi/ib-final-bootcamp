<template>
  <form>
    <p>Message is: {{ message }}</p>
    <input v-model="message" placeholder="edit me" />
  </form>
</template>

<script>
export default {
  data() {
    return { message: "asas" };
  },
  mounted() {
    console.log(this.message);
  },
  updated() {
    console.log(this.message);
  },
};
</script>
