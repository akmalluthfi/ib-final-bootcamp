function test() {
    console.log("yay");
}

import InstructionsIndex from "./Pages/InstructionsIndex.vue";

export const routes = [
    {
        path: "/",
        name: "instruction-index",
        component: InstructionsIndex,
    },
];
