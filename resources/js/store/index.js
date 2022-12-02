import Vue from "vue";
import Vuex from "vuex";
import axios from "axios";

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        vendors: null,
        invoiceTargets: null,
        customers: null,
    },
    getters: {
        getVendors: (state) => state.vendors,
        getInvoiceTargets: (state) => state.invoiceTargets,
        getCustomers: (state) => state.customers,
    },
    actions: {
        async fetchVendors({ commit }) {
            try {
                const data = await axios.get("/api/vendors");
                commit("SET_VENDORS", data.data.data);
            } catch (error) {
                alert(error);
                console.log(error);
            }
        },
        async fetchInvoiceTargets({ commit }) {
            try {
                const data = await axios.get("/api/invoice-targets");
                commit("SET_INVOICETARGETS", data.data.data);
            } catch (error) {
                alert(error);
                console.log(error);
            }
        },
        async fetchCustomers({ commit }) {
            try {
                const data = await axios.get("/api/customers");
                commit("SET_CUSTOMERS", data.data.data);
            } catch (error) {
                alert(error);
                console.log(error);
            }
        },
    },
    mutations: {
        SET_VENDORS(state, vendors) {
            state.vendors = vendors;
        },
        SET_INVOICETARGETS(state, invoiceTargets) {
            state.invoiceTargets = invoiceTargets;
        },
        SET_CUSTOMERS(state, customers) {
            state.customers = customers;
        },
    },
    modules: {},
});
