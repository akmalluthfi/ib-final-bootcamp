// import AppComp from './components/AppComp.vue';
import Open from "./components/pages/Open.vue";
import Instruction from "./components/pages/Instruction.vue";
import Completed from "./components/pages/Completed.vue";
import Login from "./components/pages/Login.vue";
import Details from "./components/pages/Details.vue";

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
    {
        path: "/completed",
        name: "Completed",
        component: Completed,
    },
    {
        path: "/login",
        name: "Login",
        component: Login,
    },
    {
        path: "/details/:id",
        name: "Details",
        component: Details,
        props: true,
    },
];
