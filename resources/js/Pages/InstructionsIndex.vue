<template>
  <MainLayout>
    <h1 class="fs-2 mt-4 mb-5 fw-normal text-black">3rd Party Instruction</h1>

    <div class="full-shadow rounded">
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
          <li class="nav-item">
            <a
              class="nav-link py-3 text-black-50 fw-semibold fs-5 active"
              aria-current="page"
              href="#"
              >Open</a
            >
          </li>
          <li class="nav-item">
            <a class="nav-link py-3 text-black-50 fw-semibold fs-5" href="#"
              >Completed</a
            >
          </li>
        </ul>
        <div class="col-auto">
          <button class="btn border border-1 me-2">
            <fa icon="fa-magnifying-glass" class="text-info" />
          </button>
          <a class="btn border border-1 fw-semibold">
            <fa icon="fa-file-arrow-down" class="text-info" />
            Export
          </a>
        </div>
      </div>

      <section class="px-4 py-4">
        <div class="text-end">
          <button class="btn btn-info text-white">
            <fa icon="fa-plus" />
            Create 3rd Party Instruction
          </button>
        </div>
      </section>
    </div>
  </MainLayout>
</template>

<script>
export default {};
</script>

<style scoped>
.nav-link.active {
  color: var(--bs-info) !important;
  border-bottom: 4px solid var(--bs-info) !important;
}
.full-shadow {
  box-shadow: 0 0 0.5rem rgb(0 0 0 / 10%) !important;
}
</style>