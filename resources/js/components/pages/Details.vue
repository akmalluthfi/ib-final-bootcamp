<template>
  <div>
    <navbar></navbar>
    <ModalInvoice></ModalInvoice>
    <div class="container-fluid mt-5">
      <h2>3rd Party Instruction</h2>
      <p>
        Vendor Management
        <span class="text-success">> 3rd Party Instruction</span>
      </p>
      <div class="container mt-5">
        <div class="form-group row mt-5">
          <div class="col-2">
            <label class="text-muted fs-5 fw-light">Type</label>
            <p class="fs-4 fw-bold">
              <font-awesome-icon
                icon="fa-solid fa-truck fs-3"
                class="text-muted"
              />&nbsp; Logistic Instruction
            </p>
          </div>
          <div class="col-2">
            <label class="text-muted fs-5 fw-light">Instruction ID</label>
            <p class="fs-3 fw-bold">{{ this.details.no }}</p>
          </div>
          <div class="col-2">
            <label class="text-muted fs-5 fw-light">Transfer No.</label>
            <p class="fs-3 fw-bold">PPKN-2021-03</p>
          </div>
          <div class="col-2">
            <label class="text-muted fs-5 fw-light">Customer</label>
            <p class="fs-3 fw-bold">{{ this.details.customer }}</p>
          </div>
          <div class="col-2">
            <label class="text-muted fs-5 fw-light">Customer Po.</label>
            <p class="fs-3 fw-bold">{{ this.details.customer_po_no }}</p>
          </div>
          <div class="col-2">
            <label>Status</label>
            <status-badge :status="this.details.status" />
          </div>
        </div>

        <div class="row mt-5">
          <div class="col-2">
            <label class="text-muted fs-5 fw-light">Attention Of</label>
            <p class="fs-3 fw-bold">{{ this.details.attention_of }}</p>
          </div>
          <div class="col-2">
            <label class="text-muted fs-5 fw-light">Assigned Vendor</label>
            <p class="fs-3 fw-bold">{{ this.details.assigned_vendor }}</p>
          </div>
          <div class="col-2">
            <label class="text-muted fs-5 fw-light">Vendor Quotation No.</label>
            <p class="fs-3 fw-bold">{{ this.details.quotation_no }}</p>
          </div>
          <div class="col-5">
            <label class="text-muted fs-5 fw-light">Vendor Address</label>
            <p class="fs-3 fw-bold">
              {{ this.details.vendor_address }}
            </p>
          </div>
        </div>

        <div class="row mt-5">
          <p class="fs-3 fw-bold">Cost Detail</p>
          <table class="table fs-4">
            <thead>
              <tr class="bg-secondary text-white fw-bolder fs-5">
                <th scope="col">Description</th>
                <th scope="col">Qty</th>
                <th scope="col">UOM</th>
                <th scope="col">Unit Price</th>
                <th scope="col">Discount (%)</th>
                <th scope="col">VAT(%)</th>
                <th scope="col">Currency</th>
                <th scope="col">VAT Amount</th>
                <th scope="col">Sub Total</th>
                <th scope="col">Total</th>
                <th scope="col">Charge To</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(item, index) in details.costs" :key="index">
                <td>
                  <p>{{ item.description }}</p>
                </td>
                <td>
                  <p>{{ item.qty }}</p>
                </td>
                <td>
                  <p>{{ item.uom }}</p>
                </td>
                <td>
                  <p>{{ item.unit_price }}</p>
                </td>
                <td>
                  <p>{{ item.discount }}%</p>
                </td>
                <td>{{ item.vat }}%</td>
                <td>
                  <p>AED (Total)</p>
                </td>
                <td>{{ item.vat_amount }}</td>
                <td>{{ item.sub_total }}</td>
                <td>{{ item.total }}</td>
                <td>{{ item.charge_to }}</td>
              </tr>
            </tbody>
          </table>
        </div>

        <div class="row mt-5 d-flex justify-content-between">
          <div class="w-50">
            <p class="fs-3 fw-bold">Attachment</p>
            <div
              class="d-flex w-50"
              v-for="(item, index) in details.attachments"
              :key="index"
            >
              <font-awesome-icon
                icon="fa-solid fa-paperclip"
                class="text-info fs-1"
              />
              <div class="mx-3 mt-0">
                <p class="fs-3 my-0 text-info fw-bold">Nama File.pdf</p>
                <p>author, waktu</p>
              </div>
            </div>
            <div class="mt-2">
              <button class="btn btn-info">
                <font-awesome-icon icon="fa-solid fa-plus" /> Add Attachment
              </button>
            </div>
          </div>

          <div class="w-50">
            <p class="fs-3 fw-bold">Notes</p>
            <p class="fs-4 fw-bold">{{ this.details.note }}</p>
          </div>

          <div class="w-50 my-3">
            <p class="fs-3 fw-bold">Vendor Invoice</p>

            <div
              class="d-flex w-50"
              v-for="(item, index) in details.vendor_invoices"
              :key="index"
            >
              <font-awesome-icon
                icon="fa-solid fa-paperclip"
                class="text-info fs-1"
              />
              <div class="mx-3 mt-0">
                <p class="fs-3 my-0 text-info fw-bold">{{ item.no }}</p>
                <p>ID: {{ item.id }}</p>
              </div>
            </div>
            <div class="mt-2">
              <button class="btn btn-info">
                <font-awesome-icon icon="fa-solid fa-plus" /> Add Invoices
              </button>
            </div>
          </div>
        </div>

        <div class="row w-100 bg-dark-gray">
          <p class="my-2 ms-4 text-white fs-3 fw-bold">For Internal Only</p>
        </div>

        <div class="row mt-5 d-flex justify-content-between">
          <div class="w-50">
            <p class="fs-3 fw-bold">Attachment</p>
            <div
              class="d-flex w-50"
              v-for="(item, index) in internal.attachments"
              :key="index"
            >
              <font-awesome-icon
                icon="fa-solid fa-paperclip"
                class="text-info fs-1"
              />
              <div class="mx-3 mt-0">
                <p class="fs-3 my-0 text-info fw-bold">Nama File.pdf</p>
                <p>author, waktu</p>
              </div>
            </div>
            <div class="mt-2">
              <button class="btn btn-info">
                <font-awesome-icon icon="fa-solid fa-plus" /> Add Attachment
              </button>
            </div>
          </div>
          <div class="w-50">
            <p class="fs-3 fw-bold">Notes</p>
            <div
              class="note-cont"
              v-for="(item, index) in internal.notes"
              :key="index"
            >
              <p class="fs-4 fw-bold">
                {{ item.note }}
              </p>
              <p>By. {{ item.noted_by }}</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import StatusBadge from "../partials/StatusBadge.vue";
import axios from "axios";

export default {
  components: { StatusBadge },
  props: ["type"],
  data() {
    return {
      details: {
        // costs: [],
      },
      internal: {},
    };
  },
  methods: {
    getDetails() {
      axios
        .get("/api/instructions/" + this.$route.params.id)
        .then((response) => {
          this.details = response.data.data;

          this.details.costs.forEach((item) => {
            item.vat_amount = item.vat_amount.toFixed(2);
            item.sub_total = item.sub_total.toFixed(2);
            item.total = item.total.toFixed(2);
          });

          this.internal = response.data.data.internal;
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
  beforeMount() {
    this.getDetails();
  },
  mounted() {},
};
</script>

<style>
.bg-dark-gray {
  background-color: #57595b;
}
</style>