<div class="card card-flush h-lg-100" id="container-summary-count">
    <div class="card-header mt-6">
        <div class="card-title flex-column">
            <h3 class="fw-bold mb-1"> Tasks Summary </h3>
            <div class="fs-6 fw-semibold text-gray-400"> 24 Overdue Tasks </div>
        </div>
        <div class="card-toolbar">
            <a href="#" class="btn btn-light btn-sm">View Tasks</a>
        </div>
    </div>
    <div class="card-body p-9 pt-5">
        <div class="d-flex flex-wrap">
            <div class="position-relative d-flex flex-center h-175px w-175px me-15 mb-7">
                <div class="position-absolute translate-middle start-50 top-50 d-flex flex-column flex-center">
                    <span class="fs-2qx fw-bold" id="overview-total-count">237</span>
                    <span class="fs-6 fw-semibold text-gray-400">Total Tasks</span>
                </div>
                <canvas id="project_overview_chart" width="175" height="175" style="
                        display: block;
                        box-sizing: border-box;
                        height: 175px;
                        width: 175px;
                    "></canvas>
            </div>
            <div class="d-flex flex-column justify-content-center flex-row-fluid pe-11 mb-5">
                <div class="d-flex fs-6 fw-semibold align-items-center mb-3">
                    <div class="bullet bg-primary me-3"></div>
                    <div class="text-gray-400"> In Progress </div>
                    <div class="ms-auto fw-bold text-gray-700" id="overview-progress-count"> 30 </div>
                </div>
                <div class="d-flex fs-6 fw-semibold align-items-center mb-3">
                    <div class="bullet bg-success me-3"></div>
                    <div class="text-gray-400"> Done </div>
                    <div class="ms-auto fw-bold text-gray-700" id="overview-done-count"> 45 </div>
                </div>
                <div class="d-flex fs-6 fw-semibold align-items-center mb-3">
                    <div class="bullet bg-danger me-3"></div>
                    <div class="text-gray-400"> Pending </div>
                    <div class="ms-auto fw-bold text-gray-700" id="overview-pending-count"> 0 </div>
                </div>
                <div class="d-flex fs-6 fw-semibold align-items-center">
                    <div class="bullet bg-gray-300 me-3"></div>
                    <div class="text-gray-400"> Freeze </div>
                    <div class="ms-auto fw-bold text-gray-700" id="overview-freeze-count"> 25 </div>
                </div>
            </div>
        </div>
        <div class="notice d-flex bg-light-primary rounded border-primary border border-dashed p-6">
            <div class="d-flex flex-stack flex-grow-1">
                <div class="fw-semibold">
                    <div class="fs-6 text-gray-700">
                        <a href="#" class="fw-bold me-1">Invite New .NET Collaborators</a> to create great outstanding business to business .jsp modutr class scripts
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $('#container-summary-count').ready(function() {
        work_list_id = {{$work_list_id}};

        $.ajax({
            url: "{{route('com.promag.detail.getSummaryCountPromag', ['work_list_id' => $work_list_id])}}",
            type: 'GET',
            // Ganti "item_id" sesuai dengan nama parameter yang diharapkan pada controller
            success: function(response) {
                console.log(response);
                $('#overview-total-count').html(response.data.total);
                $('#overview-progress-count').html(response.data.progress);
                $('#overview-done-count').html(response.data.done);
                $('#overview-pending-count').html(response.data.pending);
                $('#overview-freeze-count').html(response.data.freeze);
            },
            error: function(error) {
                console.error(error.responseJSON);
                toastr.error(error.responseJSON.message, 'Opps!')
            }
        });
    })
</script>