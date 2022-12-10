<template>
  <div>
    <Navbar />
    <main class="container-xxl">
      <slot></slot>
    </main>
  </div>
</template>

<script>
import Navbar from "../Components/Navbar";

export default {
  components: {
    Navbar,
  },
};
</script>