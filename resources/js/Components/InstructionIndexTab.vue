<template>
  <div
    class="
      d-flex
      justify-content-between
      align-items-center
      border-bottom border-2 border-secondary border-opacity-10
      px-4
      pt-2
    "
  >
    <ul class="nav">
      <li class="nav-item" v-for="(tab, index) in tabs" :key="index">
        <router-link
          class="nav-link py-3 text-black-50 fw-semibold fs-5"
          :class="{ active: setActive(tab) }"
          :to="{ name: 'instruction-index', query: { tab: tab.toLowerCase() } }"
          @click="$emit('handleTab', tab.toLowerCase())"
        >
          {{ tab }}
        </router-link>
      </li>
    </ul>
    <div class="col-auto d-flex">
      <!-- <input type="email" class="form-control me-3" /> -->
      <div class="search-bar">
        <form class="search-form" method="POST" action="#">
          <input
            type="text"
            name="query"
            placeholder="Search"
            title="Enter search keyword"
          />
          <button type="submit" title="Search">
            <fa icon="fa-magnifying-glass" class="text-info" />
          </button>
        </form>
      </div>
      <a class="btn border border-1 fw-semibold text-nowrap">
        <fa icon="fa-file-arrow-down" class="text-info" />
        Export
      </a>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    active: Boolean,
    tabs: Array,
  },
  methods: {
    setActive: function (tab) {
      if (tab === "Open" && this.active) return true;
      if (tab === "Completed" && !this.active) return true;

      return false;
    },
  },
};
</script>

<style scoped>
.nav-link.active {
  color: var(--bs-info) !important;
  border-bottom: 4px solid var(--bs-info) !important;
}

.search-bar {
  min-width: 320px;
  padding: 0 1rem;
  position: relative;
  margin-top: 1px;
}

.search-form {
  width: 100%;
  position: relative;
}

.search-form input {
  border: 0;
  font-size: 14px;
  border: 1px solid rgb(206, 212, 218);
  padding: 6px 7px 6px 30px;
  border-radius: 3px;
  transition: 0.3s;
  width: 100%;
  position: absolute;
  top: 0;
  right: 0;
}

.search-form input:focus,
.search-form input:hover {
  outline: none;
}

.search-form button {
  border: 0;
  padding: 0;
  background: none;
  position: absolute;
  top: 6px;
  left: 10px;
}
</style>