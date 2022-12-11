import InstructionsIndex from "./Pages/InstructionsIndex.vue";
import InstructionIndexOpen from "./Components/InstructionIndexOpen.vue";

const test = {
    template: "<h1>test</h1>",
};

const Create = {
    template: "<h1>Create desu</h1>",
};

export const routes = [
    {
        path: "/",
        name: "instruction-index",
        component: InstructionsIndex,
    },
    {
        path: "/create",
        name: "instruction-create",
        component: Create,
    },
];
