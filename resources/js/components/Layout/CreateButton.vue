<template>
  <div class="dropdown mt-4 mb-2 ms-auto">
    <button
      class="btn btn-info dropdown-toggle float-end"
      type="button"
      id="dropdownMenuButton1"
      data-bs-toggle="dropdown"
      aria-expanded="false"
    >
      <i class="fa fa-plus" aria-hidden="true"></i> Create 3rd Party Instruction
    </button>
    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
      <li>
        <router-link
          class="dropdown-item"
          :to="{ name: 'Instruction', params: { type: 'LI' } }"
          ><i class="fa-solid fa-truck"></i> Logistic Instruction</router-link
        >
      </li>
      <li>
        <router-link
          class="dropdown-item"
          :to="{ name: 'Instruction', params: { type: 'SI' } }"
          ><i class="fa fa-user" aria-hidden="true"></i> Service
          Instruction</router-link
        >
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  data() {
    return {
      types: [
        {
          id: 1,
          nama: "LI",
        },
        {
          id: 2,
          nama: "SI",
        },
      ],
    };
  },
};
</script>

<style></style>
