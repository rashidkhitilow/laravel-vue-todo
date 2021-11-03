<template>
  <div class="row">
    <div class="col-auto mb-3">
      <h5 style="padding-top: 7px;">
        <i class="fas fa-filter"></i>
      </h5>
    </div>
    <div class="col-1 mb-3">
      <input
        placeholder="ID..."
        type="text"
        class="form-control"
        name="ff__id"
        value=""
      />
    </div>
    <div class="col-auto mb-3">
      <input
        placeholder="From date..."
        type="text"
        class="form-control filter_date_picker"
        name="ff__from_date"
        value=""
      />
    </div>
    <div class="col-auto mb-3">
      <input
        placeholder="To date..."
        type="text"
        class="form-control filter_date_picker"
        name="ff__to_date"
        value=""
      />
    </div>
    <div class="col-auto mb-3">
      <input
        placeholder="Client ref..."
        type="text"
        class="form-control"
        name="ff__client_ref"
        value=""
      />
    </div>
    <div class="col-auto mb-3">
      <button
        type="button"
        id="reset_filter"
        class="btn btn-primary"
      >
        <i class="fas fa-eraser"></i> Reset
      </button>
    </div>
    <div class="col-auto mb-3">
      <button type="button" class="btn btn-success">
        <i class="fas fa-file-excel"></i> &nbsp;Export Excel
      </button>
    </div>
  </div>
</template>
<script>
export default {};
</script>

<style></style>
