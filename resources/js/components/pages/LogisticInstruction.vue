<template>
    <div>
        <navbar></navbar>
        <ModalInvoice></ModalInvoice>
        <div class="container mt-5">
            <h2>3rd Party Instruction</h2>
            <p>
                Vendor Management
                <span class="text-success">> 3rd Party Instruction</span>
            </p>
            <div class="card mt-5 p-5">
                <div class="card-body">
                    <div class="row justify-content-between">
                        <div class="col-md-6">
                            <div class="dropdown">
                                <button
                                    class="btn btn-light dropdown-toggle fw-bold"
                                    type="button"
                                    id="dropdownMenuButton1"
                                    data-bs-toggle="dropdown"
                                    aria-expanded="false"
                                >
                                    <i
                                        class="fa-solid fa-truck text-success"
                                    ></i>
                                    Logistic Instruction
                                </button>
                                <ul
                                    class="dropdown-menu"
                                    aria-labelledby="dropdownMenuButton1"
                                >
                                    <li>
                                        <router-link
                                            class="dropdown-item"
                                            to="#"
                                            ><i
                                                class="fa fa-user"
                                                aria-hidden="true"
                                            ></i>
                                            Service Instruction</router-link
                                        >
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-6 text-end">
                            <button class="btn-draft">Draft</button>
                        </div>
                    </div>
                    <form action="" method="post">
                        <div class="form-group row mt-5">
                            <div class="col-3">
                                <label for="" class="form-control-label"
                                    >Assigned Vendor</label
                                >
                                <select
                                    class="form-control selectpicker"
                                    id="select-vendor"
                                    data-live-search="true"
                                    required
                                >
                                    <option disabled selected hidden>
                                        Enter Vendor
                                    </option>
                                    <option data-tokens="china">China</option>
                                    <option data-tokens="malayasia">
                                        Malayasia
                                    </option>
                                    <option data-tokens="singapore">
                                        Singapore
                                    </option>
                                </select>
                            </div>
                            <div class="col-3">
                                <label for="" class="form-control-label"
                                    >Attention Of</label
                                >
                                <input
                                    type="text"
                                    class="form-control"
                                    placeholder="Enter Attention Of"
                                    required
                                />
                            </div>
                            <div class="col-2">
                                <label for="" class="form-control-label"
                                    >Quotation No.</label
                                >
                                <input
                                    type="text"
                                    class="form-control"
                                    placeholder="Enter Quotation"
                                    required
                                />
                            </div>
                            <div class="col-2">
                                <label for="" class="form-control-label"
                                    >Invoice To</label
                                >
                                <select
                                    class="form-control selectpicker"
                                    id="select-invoice"
                                    data-live-search="true"
                                    required
                                >
                                    <option disabled selected hidden>
                                        Select an Option
                                    </option>
                                    <option data-tokens="china">China</option>
                                    <option data-tokens="malayasia">
                                        Malayasia
                                    </option>
                                    <option data-tokens="singapore">
                                        Singapore
                                    </option>
                                    <option>
                                        <button
                                            type="button"
                                            class="btn btn-outline-success"
                                            data-toggle="modal"
                                            data-target="#exampleModal"
                                        >
                                            <i
                                                class="fa fa-plus"
                                                aria-hidden="true"
                                            ></i>
                                            Add New Invoice
                                        </button>
                                    </option>
                                </select>
                            </div>
                            <div class="col-2">
                                <label for="" class="form-control-label"
                                    >Customer - Contract</label
                                >
                                <select
                                    class="form-control selectpicker"
                                    id="select-customer"
                                    data-live-search="true"
                                    required
                                >
                                    <option disabled selected hidden>
                                        Select Customer
                                    </option>
                                    <option data-tokens="china">China</option>
                                    <option data-tokens="malayasia">
                                        Malayasia
                                    </option>
                                    <option data-tokens="singapore">
                                        Singapore
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row mt-5">
                            <div class="col-10">
                                <label for="" class="form-control-label"
                                    >Vendor Address</label
                                >
                                <select
                                    class="form-control selectpicker"
                                    id="select-vendor-address"
                                    data-live-search="true"
                                    required
                                >
                                    <option disabled selected hidden>
                                        Enter Vendor Address
                                    </option>
                                    <option data-tokens="china">China</option>
                                    <option data-tokens="malayasia">
                                        Malayasia
                                    </option>
                                    <option data-tokens="singapore">
                                        Singapore
                                    </option>
                                </select>
                            </div>
                            <div class="col-2">
                                <label for="" class="form-control-label"
                                    >Customer PO No.</label
                                >
                                <input
                                    type="text"
                                    class="form-control"
                                    placeholder="Enter Customer PO"
                                />
                            </div>
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
                                                        <select
                                                            class="form-select"
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
                                                            placeholder="Enter Unit Price"
                                                        />
                                                    </td>
                                                    <td>
                                                        <input
                                                            type="number"
                                                            class="form-control"
                                                            min="0"
                                                        />
                                                    </td>
                                                    <th>
                                                        <input
                                                            type="number"
                                                            class="form-control"
                                                            min="0"
                                                        />
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
                                                        <select
                                                            class="form-select"
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
                                                                    class="btn btn-success"
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
                                                <label class="btn btn-success">
                                                    <i
                                                        class="fa fa-plus"
                                                        aria-hidden="true"
                                                    ></i>
                                                    Add Attachment
                                                    <input type="file" hidden />
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
                                <div class="card-body d-flex justify-content-end">
                                    <button type="button" class="btn btn-light me-3">
                                        Cancel
                                    </button>
                                    <button
                                        type="button"
                                        class="btn btn-secondary me-3"
                                    >
                                        Save as Draft
                                    </button>
                                    <button
                                        type="submit"
                                        class="btn btn-success"
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
$(function () {
    $(".selectpicker").selectpicker();
});

export default {};
</script>

<style>
.btn-draft {
    border: none;
    height: 35px;
    width: 150px;
    border-radius: 20px;
}
</style>
