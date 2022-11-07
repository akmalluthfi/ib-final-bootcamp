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
            <div class="card mt-4">
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
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

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
