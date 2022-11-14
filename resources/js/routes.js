// import AppComp from './components/AppComp.vue';
import Open from "./components/pages/Open.vue";
import Instruction from "./components/pages/Instruction.vue";

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
    // {
    //     path:"service-instruction",
    //     name:"ServiceInstruction",
    //     component: ServiceInstruction,
    // }
];
