import Vue from "vue";
import VueRouter from "vue-router";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import { routes } from "./routes";
import VueObserveVisibility from "vue-observe-visibility";

require("./bootstrap");

// Configure icons
Vue.component("fa", FontAwesomeIcon);

// Vue.config.productionTip = false
// global components
Vue.component("MainLayout", require("./Layouts/MainLayout.vue").default);

// configure infitite scroll package
Vue.use(VueObserveVisibility);

// Vue Router configuration
const router = new VueRouter({ mode: "history", routes });
Vue.use(VueRouter);

new Vue({ router }).$mount("#app");
