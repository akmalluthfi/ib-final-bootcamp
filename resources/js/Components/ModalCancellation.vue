<template>
  <div
    class="modal fade"
    id="cancellationModal"
    tabindex="-1"
    aria-labelledby="cancellationModalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1
            class="modal-title fs-5 col text-center"
            id="cancellationModalLabel"
          >
            Reason of Cancellation
          </h1>
          <button
            type="button"
            class="btn-close col-auto"
            data-bs-dismiss="modal"
            aria-label="Close"
          ></button>
        </div>
        <div class="modal-body">
          <div class="row g-3 mb-5">
            <div class="col-md-6">
              <label for="transfer-no" class="form-label">Transfer No</label>
              <input
                type="text"
                class="form-control"
                id="transfer-no"
                disabled
                value="TRF-2022-0034"
              />
            </div>
            <div class="col-md-6">
              <label for="cancelled-by" class="form-label">Cancelled By</label>
              <input
                type="text"
                class="form-control"
                id="cancelled-by"
                disabled
                :value="cancellation.cancelled_by"
              />
            </div>
            <div class="col-12">
              <label for="description" class="form-label">Description</label>
              <textarea
                class="form-control"
                id="description"
                rows="3"
                disabled
                :value="cancellation.reason"
              />
            </div>
            <div class="col-12">
              <div class="form-label">Attachment</div>
            </div>
          </div>
        </div>
        <div class="modal-footer justify-content-center">
          <button
            type="button"
            class="btn btn-info px-5"
            data-bs-dismiss="modal"
          >
            Done
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    cancellation: Object,
  },
};
</script>