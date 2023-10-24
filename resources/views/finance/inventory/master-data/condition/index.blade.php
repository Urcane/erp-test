@can('FIN:crud-masterdata-inventory')
    @include('finance.inventory.master-data.condition.modal')
@endcan

<div class="d-flex justify-content-end mb-5">
    <div class="input-group w-150px w-md-250px mx-4">
        <span class="input-group-text border-0"><i class="fa-solid fa-magnifying-glass"></i></span>
        <input class="form-control form-control-solid form-control-sm" autocomplete="off" id="condition_search">
    </div>
    @can('FIN:crud-masterdata-inventory')
        <a href="#add_condition_modal" data-bs-toggle="modal" class="btn btn-info btn-sm me-3 fs-8">
            <i class="fa-solid fa-plus"></i>
            Add Kondisi
        </a>
    @else
        <div class="btn btn-outline btn-outline-muted text-muted btn-sm me-3 fs-8 cursor-not-allowed">
            <i class="fa-solid fa-plus"></i>
            Add Kondisi (Resisted)
        </div>
    @endcan
</div>

<div class="row">
    <div class="col-lg-12">
        <table class="table align-top border table-rounded gy-5" id="kt_table_condition">
            <thead class="">
                <tr class="fw-bold fs-7 text-gray-500 text-uppercase overflow-y-auto">
                    <th class="text-center w-50px">#</th>
                    <th class="w-600px">Kondisi</th>
                    <th class="w-150px">#</th>
                </tr>
            </thead>
            <tbody class="fs-7">
            </tbody>
        </table>
    </div>
</div>
