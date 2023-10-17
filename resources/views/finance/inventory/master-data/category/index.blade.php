@include('finance.inventory.master-data.category.modal')

<div class="d-flex justify-content-end mb-5">
    <div class="input-group w-150px w-md-250px mx-4">
        <span class="input-group-text border-0"><i class="fa-solid fa-magnifying-glass"></i></span>
        <input class="form-control form-control-solid form-control-sm" autocomplete="off"
            id="category_search">
    </div>
    <a href="#add_category_modal" data-bs-toggle="modal" class="btn btn-info btn-sm me-3 fs-8">
        <i class="fa-solid fa-plus"></i>
        Add Category
    </a>
</div>

<div class="row">
    <div class="col-lg-12">
        <table class="table align-top border table-rounded gy-5" id="kt_table_category">
            <thead class="">
                <tr class="fw-bold fs-7 text-gray-500 text-uppercase overflow-y-auto">
                    <th class="text-center w-50px">#</th>
                    <th class="w-300px">Category</th>
                    <th class="w-300px">Code</th>
                    <th class="w-150px">#</th>
                </tr>
            </thead>
            <tbody class="fs-7">
            </tbody>
        </table>
    </div>
</div>
