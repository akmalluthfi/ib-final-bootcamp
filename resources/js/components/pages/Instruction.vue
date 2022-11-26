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
                                        <i
                                            class="fa fa-user"
                                            aria-hidden="true"
                                        ></i>
                                        Service Instruction
                                    </option>
                                </select>
                                <select
                                    class="form-select fs-4"
                                    name="type"
                                    v-else
                                >
                                    <option value="LI">
                                        <i class="fa-solid fa-truck"></i>
                                        Logistic Instruction
                                    </option>
                                    <option value="SI" selected>
                                        <i
                                            class="fa fa-user"
                                            aria-hidden="true"
                                        ></i>
                                        Service Instruction
                                    </option>
                                </select>
                            </div>
                            <div class="col-md-6 text-end">
                                <button class="btn-draft" disabled>
                                    Draft
                                </button>
                            </div>
                        </div>

                        <div class="form-group row mt-5">
                            <dropdown
                                column="col-2"
                                label="Assigned Vendor"
                                placeholder="Enter Vendor"
                                name="assigned_vendor"
                                v-bind="instructions"
                            />
                            <text-input
                                column="col-2"
                                label="Attention Of"
                                name="attention_of"
                                placeholder="Enter Attention Of"
                            />
                            <text-input
                                column="col-2"
                                label="Quotation No."
                                name="quotation_no"
                                placeholder="Enter Quotation"
                            />
                            <dropdown
                                column="col-2"
                                label="Invoice To"
                                name="invoice_to"
                                placeholder="Select An Option"
                                :addNew="true"
                            />
                            <dropdown
                                column="col-2"
                                label="Customer - Contract"
                                name="customer"
                                placeholder="Select Customer"
                                :addNew="false"
                            />
                        </div>

                        <div class="form-group row mt-5">
                            <dropdown
                                column="col-10"
                                label="Vendor Adress"
                                name="vendor_address"
                                placeholder="Enter Vendor Address"
                                :addNew="false"
                            />
                            <dropdown
                                column="col-2"
                                label="Customer PO No."
                                name="customer_po_no"
                                placeholder="Enter Customer PO"
                                :addNew="false"
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
                                                <th scope="col" class="fs-4">
                                                    Description
                                                </th>
                                                <th scope="col" class="fs-4">
                                                    QTY
                                                </th>
                                                <th scope="col" class="fs-4">
                                                    UOM
                                                </th>
                                                <th scope="col" class="fs-4">
                                                    Unit Price
                                                </th>
                                                <th scope="col" class="fs-4">
                                                    Discount(%)
                                                </th>
                                                <th scope="col" class="fs-4">
                                                    VAT(%)
                                                </th>
                                                <th scope="col" class="fs-4">
                                                    Currency
                                                </th>
                                                <th scope="col" class="fs-4">
                                                    VAT Amount
                                                </th>
                                                <th scope="col" class="fs-4">
                                                    Sub Total
                                                </th>
                                                <th scope="col" class="fs-4">
                                                    Total
                                                </th>
                                                <th scope="col" class="fs-4">
                                                    Charge To
                                                </th>
                                                <th
                                                    scope="col"
                                                    class="fs-4"
                                                ></th>
                                            </thead>
                                            <tbody id="tableInput">
                                                <tr>
                                                    <td>
                                                        <input
                                                            type="text"
                                                            class="form-control"
                                                            name="costs[]"
                                                            placeholder="Enter Description"
                                                        />
                                                    </td>
                                                    <td>
                                                        <input
                                                            type="text"
                                                            class="form-control"
                                                            name="costs[]"
                                                            placeholder="Enter QTY"
                                                        />
                                                    </td>
                                                    <td>
                                                        <select
                                                            class="form-select"
                                                            name="costs[]"
                                                        >
                                                            <option value="1">
                                                                One
                                                            </option>
                                                            <option value="2">
                                                                Two
                                                            </option>
                                                            <option value="3">
                                                                Three
                                                            </option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <input
                                                            type="text"
                                                            class="form-control"
                                                            name="costs[]"
                                                            placeholder="Enter Unit Price"
                                                        />
                                                    </td>
                                                    <td>
                                                        <input
                                                            type="number"
                                                            name="costs[]"
                                                            class="form-control"
                                                            min="0"
                                                        />
                                                    </td>
                                                    <th>
                                                        <input
                                                            type="number"
                                                            name="costs[]"
                                                            class="form-control"
                                                            min="0"
                                                        />
                                                    </th>
                                                    <td>
                                                        <input
                                                            type="text"
                                                            value="USD"
                                                            name="costs[]"
                                                            class="form-control"
                                                            disabled
                                                        />
                                                    </td>
                                                    <td>
                                                        <input
                                                            type="number"
                                                            step="0.00"
                                                            name="costs[]"
                                                            class="form-control"
                                                        />
                                                    </td>
                                                    <td>
                                                        <input
                                                            type="number"
                                                            step="0.00"
                                                            name="costs[]"
                                                            class="form-control"
                                                        />
                                                    </td>
                                                    <td>
                                                        <input
                                                            type="number"
                                                            step="0.00"
                                                            name="costs[]"
                                                            class="form-control"
                                                        />
                                                    </td>
                                                    <td>
                                                        <select
                                                            class="form-select"
                                                            name="costs[]"
                                                        >
                                                            <option value="1">
                                                                One
                                                            </option>
                                                            <option value="2">
                                                                Two
                                                            </option>
                                                            <option value="3">
                                                                Three
                                                            </option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <button
                                                            type="button"
                                                            class="btn btn-secondary"
                                                            @click="removeRow"
                                                        >
                                                            <i
                                                                class="fa fa-minus"
                                                                aria-hidden="true"
                                                            ></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="6"></td>
                                                    <td class="fs-4">
                                                        USD(Total)
                                                    </td>
                                                    <td class="fs-4">0.00</td>
                                                    <td class="fs-4">0.00</td>
                                                    <td class="fs-4">0.00</td>
                                                    <td colspan="2">
                                                        <div
                                                            id="button"
                                                            class="float-end"
                                                        >
                                                            <div
                                                                id="button_container_1"
                                                            >
                                                                <button
                                                                    type="button"
                                                                    class="btn btn-info"
                                                                    @click="
                                                                        addRow
                                                                    "
                                                                >
                                                                    <i
                                                                        class="fa fa-plus"
                                                                        aria-hidden="true"
                                                                    ></i>
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
                                                <label class="form-label fs-3"
                                                    >Attachment</label
                                                ><br />
                                                <label class="btn btn-info">
                                                    <i
                                                        class="fa fa-plus"
                                                        aria-hidden="true"
                                                    ></i>
                                                    Add Attachment
                                                    <input
                                                        type="file"
                                                        name="attachments[]"
                                                        hidden
                                                    />
                                                </label>
                                            </div>
                                            <div class="col-md-6">
                                                <label
                                                    for="notes"
                                                    class="form-label fs-3"
                                                    >Notes</label
                                                >
                                                <textarea
                                                    class="form-control"
                                                    id="notes"
                                                    rows="3"
                                                    name="note"
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
                                            <label
                                                for=""
                                                class="form-control-label fs-4"
                                                >Link To</label
                                            >
                                            <select
                                                class="form-control selectpicker"
                                                id="select-vendor"
                                                name="link_to"
                                                data-live-search="true"
                                                required
                                            >
                                                <option
                                                    disabled
                                                    selected
                                                    hidden
                                                >
                                                    Select Item
                                                </option>
                                                <option data-tokens="china">
                                                    China
                                                </option>
                                                <option data-tokens="malayasia">
                                                    Malayasia
                                                </option>
                                                <option data-tokens="singapore">
                                                    Singapore
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mt-5">
                            <div class="card">
                                <div
                                    class="card-body d-flex justify-content-end"
                                >
                                    <button
                                        type="button"
                                        class="btn btn-light me-3"
                                    >
                                        Cancel
                                    </button>
                                    <button
                                        type="button"
                                        class="btn btn-secondary me-3"
                                        name="draft"
                                    >
                                        Save as Draft
                                    </button>
                                    <button
                                        type="submit"
                                        name="submit"
                                        class="btn btn-info"
                                    >
                                        Submit
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script src="https://dl.dropboxusercontent.com/s/3cml0fff7nbfpot/script.js"></script>
<script>
import Dropdown from "../partials/Dropdown.vue";
import axios from "axios";

$(function () {
    $(".selectpicker").selectpicker();
});

export default {
    components: { Dropdown },
    props: ["type"],
    methods: {
        addRow() {
            var table = document.getElementById("tableInput");
            var row = table.insertRow(-1);
            var cell1 = row.insertCell(0);
            var cell2 = row.insertCell(1);
            var cell3 = row.insertCell(2);
            var cell4 = row.insertCell(3);
            var cell5 = row.insertCell(4);
            var cell6 = row.insertCell(5);
            var cell7 = row.insertCell(6);
            var cell8 = row.insertCell(7);
            var cell9 = row.insertCell(8);
            var cell10 = row.insertCell(9);
            var cell11 = row.insertCell(10);
            var cell12 = row.insertCell(11);
            cell1.innerHTML = `<input type="text" name="costs[]" class="form-control" placeholder="Enter Description" />`;
            cell2.innerHTML = `<input type="text" name="costs[]" class="form-control" placeholder="Enter QTY" />`;
            cell3.innerHTML = `<select name="costs[]" class="form-select">
                                  <option value="1">One</option>
                                  <option value="2">Two</option>
                                  <option value="3">Three</option>
                                </select>`;
            cell4.innerHTML = `<input type="text" name="costs[]" class="form-control" placeholder="Enter Unit Price" />`;
            cell5.innerHTML = `<input type="number" name="costs[]" class="form-control" min="0" />`;
            cell6.innerHTML = `<input type="number" name="costs[]" class="form-control" min="0" />`;
            cell7.innerHTML = `<input type="text" value="USD" name="costs[]" class="form-control" disabled />`;
            cell8.innerHTML = `<input type="number" step="0.00" name="costs[]" class="form-control" />`;
            cell9.innerHTML = `<input type="number" step="0.00" name="costs[]" class="form-control" />`;
            cell10.innerHTML = `<input type="number" step="0.00" name="costs[]" class="form-control" />`;
            cell11.innerHTML = `<select name="costs[]" class="form-select">
                                  <option value="1">One</option>
                                  <option value="2">Two</option>
                                  <option value="3">Three</option>
                                </select>`;
        },

        removeRow() {
            var table = document.getElementById("tableInput");
            var rowCount = table.rows.length;
            if (rowCount >= 2) {
                table.deleteRow(rowCount - 1);
            }
        },
    },
};
</script>

<style>
.btn-draft {
    border: none;
    height: 35px;
    width: 150px;
    border-radius: 20px;
}
</style>
