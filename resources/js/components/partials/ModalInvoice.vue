<template>
    <div
        class="modal fade"
        id="exampleModal"
        tabindex="-1"
        aria-labelledby="exampleModalLabel"
        aria-hidden="true"
    >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        <span class="fw-bold">Add Invoice Target</span>
                    </h5>
                    <button
                        type="button"
                        class="btn-close"
                        data-dismiss="modal"
                        aria-label="Close"
                    ></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-5">
                            <label for="invoiceTo" class="form-label"
                                >Invoice To</label
                            >
                            <input
                                type="text"
                                class="form-control"
                                id="invoiceTo"
                                placeholder="Invoice To"
                            />
                        </div>

                        <div class="mt-5 float-end">
                            <button
                                type="button"
                                class="btn btn-light"
                                data-dismiss="modal"
                            >
                                Cancel
                            </button>
                            <button type="submit" class="btn btn-success">
                                Submit
                            </button>
                        </div>
                    </form>
                </div>
                <!-- <div class="modal-footer">
                    <button
                        type="button"
                        class="btn btn-light"
                        data-dismiss="modal"
                    >
                        Cancel
                    </button>
                    <button type="button" class="btn btn-success">
                        Submit
                    </button>
                </div> -->
            </div>
        </div>
    </div>
</template>

<script>
export default {};
</script>

<style></style>
