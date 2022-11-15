// import AppComp from './components/AppComp.vue';
import Open from "./components/pages/Open.vue";
import LogisticInstruction from "./components/pages/LogisticInstruction.vue";

export const routes = [
    {
        path: "/",
        name: "Open",
        component: Open,
    },
    {
        path: "/instruction",
        name: "Instruction",
        component: Instruction,
    },
];
