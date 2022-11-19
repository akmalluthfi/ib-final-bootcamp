<template>
  <nav class="nav d-flex">
    <div class="d-flex">
      <router-link class="nav-link pb-1 active" to="/">
        <h5>Open</h5>
      </router-link>
      <router-link class="nav-link pb-1" to="/completed">
        <h5>Completed</h5>
      </router-link>
    </div>
    <create-button />
  </nav>
</template>

<script>
export default {
  props: {
    setActive: {
      type: String,
      default: "open",
    },
  },
  mounted() {
    // Pengkondisian tab yang aktif
    if (this.setActive == "open") {
      document.querySelector(".nav-link.active").classList.remove("active");
      document.querySelector(".nav-link:nth-child(1)").classList.add("active");
    } else if (this.setActive == "completed") {
      document.querySelector(".nav-link.active").classList.remove("active");
      document.querySelector(".nav-link:nth-child(2)").classList.add("active");
    }
  },
};
</script>

<style></style>
