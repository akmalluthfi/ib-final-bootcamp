import Vue from "vue";
import VueRouter from "vue-router";
import Datatable from "vue2-datatable-component";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import { routes } from "./routes";

require("./bootstrap");

// Configure icons
Vue.component("fa", FontAwesomeIcon);

// Vue.config.productionTip = false
// global components
Vue.component("MainLayout", require("./Layouts/MainLayout.vue").default);

// datatable configuration
Vue.use(Datatable);

// Vue Router configuration
const router = new VueRouter({ mode: "history", routes });
Vue.use(VueRouter);

new Vue({ router }).$mount("#app");
