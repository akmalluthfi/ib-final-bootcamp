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
      <div class="container mt-5 p-5">
        <div class="">
          <form action="" method="post">
            <div class="row justify-content-between">
              <div class="col-md-3 justify-content-start">
                <select
                  class="form-select fs-4"
                  name="type"
                  v-if="
                    this.$route.params.type == 'LI' ||
                    this.$route.params.type == undefined
                  "
                >
                  <option value="LI" selected>
                    <i class="fa-solid fa-truck"></i>
                    Logistic Instruction
                  </option>
                  <option value="SI">
                    <i class="fa fa-user" aria-hidden="true"></i>
                    Service Instruction
                  </option>
                </select>
                <select class="form-select fs-4" name="type" v-else>
                  <option value="LI">
                    <i class="fa-solid fa-truck"></i>
                    Logistic Instruction
                  </option>
                  <option value="SI" selected>
                    <i class="fa fa-user" aria-hidden="true"></i>
                    Service Instruction
                  </option>
                </select>
              </div>
              <div class="col-md-6 text-end">
                <button class="btn-draft" disabled>Draft</button>
              </div>
            </div>

            <div class="form-group row mt-5">
              <div class="col-2">
                <label for="" class="form-control-label">Assigned Vendor</label>
                <select
                  class="form-control"
                  id="select-vendor"
                  data-live-search="true"
                  required
                >
                  <option disabled selected hidden>Enter Vendor</option>
                  <option
                    v-for="(item, index) in vendors"
                    :key="index"
                    :data-tokens="item.name"
                    :value="item.name"
                  >
                    {{ item.name }}
                  </option>
                </select>
              </div>
              <text-input
                column="col-2"
                label="Attention Of"
                placeholder="Enter Attention Of"
              />
              <text-input
                column="col-2"
                label="Quotation No."
                placeholder="Enter Quotation"
              />
              <div class="col-2">
                <label for="" class="form-control-label">Invoice To</label>
                <select
                  class="form-control"
                  id="select-invoice"
                  data-live-search="true"
                  required
                >
                  <option disabled selected hidden>Select an Option</option>
                  <option
                    v-for="(item, index) in invoiceTargets"
                    :key="index"
                    :data-tokens="item.name"
                  >
                    {{ item.name }}
                  </option>
                  <option>
                    <button
                      type="button"
                      class="btn btn-outline-success"
                      data-toggle="modal"
                      data-target="#exampleModal"
                    >
                      <i class="fa fa-plus" aria-hidden="true"></i>
                      Add New Invoice
                    </button>
                  </option>
                </select>
              </div>
              <div class="col-2">
                <label for="" class="form-control-label"
                  >Customer Contract</label
                >
                <select
                  class="form-control"
                  id="select-customer"
                  data-live-search="true"
                  required
                >
                  <option disabled selected hidden>Select Customer</option>
                  <option
                    v-for="(item, index) in customers"
                    :key="index"
                    :data-tokens="item.name"
                  >
                    {{ item.name }}
                  </option>
                </select>
              </div>
            </div>

            <div class="form-group row mt-5">
              <div class="col-10">
                <label for="" class="form-control-label">Vendor Address</label>
                <select
                  class="form-control"
                  id="select-vendor-address"
                  data-live-search="true"
                  required
                >
                  <option disabled selected hidden>Enter Vendor Address</option>
                  <option
                    v-for="(item, index) in vendors"
                    :key="index"
                    :data-tokens="item.name"
                  >
                    {{ item.name }}
                  </option>
                </select>
              </div>
              <text-input
                column="col-2"
                label="Customer PO No."
                placeholder="Enter Customer PO"
              />
            </div>

            <div class="form-group mt-5">
              <!-- Card Table -->
              <div class="card">
                <h4 class="card-title p-4">
                  <span class="fw-bold">Cost Detail</span>
                </h4>
                <div class="card-body">
                  <div id="table">
                    <table class="table table-responsive">
                      <thead>
                        <th scope="col" class="fs-4">Description</th>
                        <th scope="col" class="fs-4">QTY</th>
                        <th scope="col" class="fs-4">UOM</th>
                        <th scope="col" class="fs-4">Unit Price</th>
                        <th scope="col" class="fs-4">Discount(%)</th>
                        <th scope="col" class="fs-4">VAT(%)</th>
                        <th scope="col" class="fs-4">Currency</th>
                        <th scope="col" class="fs-4">VAT Amount</th>
                        <th scope="col" class="fs-4">Sub Total</th>
                        <th scope="col" class="fs-4">Total</th>
                        <th scope="col" class="fs-4">Charge To</th>
                        <th scope="col" class="fs-4"></th>
                      </thead>
                      <tbody>
                        <tr>
                          <th>
                            <input
                              type="text"
                              class="form-control"
                              placeholder="Enter Description"
                            />
                          </th>
                          <td>
                            <input
                              type="text"
                              class="form-control"
                              placeholder="Enter QTY"
                            />
                          </td>
                          <td>
                            <select class="form-select">
                              <option value="1">One</option>
                              <option value="2">Two</option>
                              <option value="3">Three</option>
                            </select>
                          </td>
                          <td>
                            <input
                              type="text"
                              class="form-control"
                              placeholder="Enter Unit Price"
                            />
                          </td>
                          <td>
                            <input type="number" class="form-control" min="0" />
                          </td>
                          <th>
                            <input type="number" class="form-control" min="0" />
                          </th>
                          <td>
                            <input
                              type="text"
                              value="USD"
                              class="form-control"
                              disabled
                            />
                          </td>
                          <td>
                            <input
                              type="number"
                              step="0.00"
                              class="form-control"
                            />
                          </td>
                          <td>
                            <input
                              type="number"
                              step="0.00"
                              class="form-control"
                            />
                          </td>
                          <td>
                            <input
                              type="number"
                              step="0.00"
                              class="form-control"
                            />
                          </td>
                          <td>
                            <select class="form-select">
                              <option value="1">One</option>
                              <option value="2">Two</option>
                              <option value="3">Three</option>
                            </select>
                          </td>
                          <td>
                            <button type="button" class="btn btn-secondary">
                              <i class="fa fa-minus" aria-hidden="true"></i>
                            </button>
                          </td>
                        </tr>
                      </tbody>
                      <tfoot>
                        <tr>
                          <td colspan="6"></td>
                          <td class="fs-4">USD(Total)</td>
                          <td class="fs-4">0.00</td>
                          <td class="fs-4">0.00</td>
                          <td class="fs-4">0.00</td>
                          <td colspan="2">
                            <div id="button" class="float-end">
                              <div id="button_container_1">
                                <button type="button" class="btn btn-info">
                                  <i class="fa fa-plus" aria-hidden="true"></i>
                                </button>
                              </div>
                            </div>
                          </td>
                        </tr>
                      </tfoot>
                    </table>
                  </div>
                  <div class="mt-5">
                    <div class="row mt-5">
                      <div class="col-md-6">
                        <label class="form-label fs-3">Attachment</label><br />
                        <label class="btn btn-info">
                          <i class="fa fa-plus" aria-hidden="true"></i>
                          Add Attachment
                          <input type="file" hidden />
                        </label>
                      </div>
                      <div class="col-md-6">
                        <label for="notes" class="form-label fs-3">Notes</label>
                        <textarea
                          class="form-control"
                          id="notes"
                          rows="3"
                          style="resize: none"
                        ></textarea>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="form-group mt-5">
              <div class="card mt-5 p-4">
                <div class="card-body">
                  <div class="row">
                    <div class="col-3">
                      <label for="" class="form-control-label fs-4"
                        >Link To</label
                      >
                      <select
                        class="form-control"
                        id="select-link"
                        data-live-search="true"
                        required
                      >
                        <option disabled selected hidden>Select Item</option>
                        <option data-tokens="china">China</option>
                        <option data-tokens="malayasia">Malayasia</option>
                        <option data-tokens="singapore">Singapore</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="form-group mt-5">
              <div class="card">
                <div class="card-body d-flex justify-content-end">
                  <button type="button" class="btn btn-light me-3">
                    Cancel
                  </button>
                  <button type="button" class="btn btn-secondary me-3">
                    Save as Draft
                  </button>
                  <button type="submit" class="btn btn-info">Submit</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Dropdown from "../partials/Dropdown.vue";
import { mapGetters, mapActions } from "vuex";

export default {
  components: { Dropdown },
  props: ["type"],
  computed: {
    ...mapGetters({
      vendors: "getVendors",
      invoiceTargets: "getInvoiceTargets",
      customers: "getCustomers",
    }),
  },
  methods: {
    ...mapActions(["fetchVendors", "fetchInvoiceTargets", "fetchCustomers"]),
  },
  beforeMount() {
    this.$store.dispatch("fetchVendors");
    this.$store.dispatch("fetchInvoiceTargets");
    this.$store.dispatch("fetchCustomers");
  },
  mounted() {},
};
</script>

<style>
.btn-draft {
  border: none;
  height: 35px;
  width: 150px;
  border-radius: 20px;
}
option {
  cursor: pointer;
}
</style>