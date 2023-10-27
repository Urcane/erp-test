<div class="card card-flush h-lg-100" id="container-task-overtime">
    <link href="{{asset('sense')}}/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css"/>
    <script src="{{asset('sense')}}/plugins/global/plugins.bundle.js"></script>
    <div class="card-header mt-6">
        <div class="card-title flex-column">
            <h3 class="fw-bold mb-1"> Tasks Over Time </h3>
            <div class="fs-6 d-flex text-gray-400 fs-6 fw-semibold">
                <div class="d-flex align-items-center me-6">
                    <span class="menu-bullet d-flex align-items-center me-2">
                        <span class="bullet bg-success"></span>
                    </span> Complete
                </div>
                <div class="d-flex align-items-center">
                    <span class="menu-bullet d-flex align-items-center me-2">
                        <span class="bullet bg-primary"></span>
                    </span> Incomplete
                </div>
            </div>
        </div>
        <div class="card-toolbar">
            <select name="status" data-control="select2" data-hide-search="true" class="form-select form-select-solid form-select-sm fw-bold w-100px select2-hidden-accessible" data-select2-id="select2-data-7-1375" tabindex="-1" aria-hidden="true" data-kt-initialized="1">
                <option value="1"> 2020 Q1 </option>
                <option value="2"> 2020 Q2 </option>
                <option value="3" selected="" data-select2-id="select2-data-9-z6fb"> 2020 Q3 </option>
                <option value="4"> 2020 Q4 </option>
            </select>
            <span class="select2 select2-container select2-container--bootstrap5" dir="ltr" data-select2-id="select2-data-8-3af5" style="width: 100%">
                <span class="selection">
                    <span class="select2-selection select2-selection--single form-select form-select-solid form-select-sm fw-bold w-100px" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-status-38-container" aria-controls="select2-status-38-container">
                        <span class="select2-selection__rendered" id="select2-status-38-container" role="textbox" aria-readonly="true" title="2020 Q3">2020 Q3</span>
                        <span class="select2-selection__arrow" role="presentation">
                            <b role="presentation"></b>
                        </span>
                    </span>
                </span>
                <span class="dropdown-wrapper" aria-hidden="true"></span>
            </span>
        </div>
    </div>
    <div class="card-body pt-10 pb-0 px-5">
        <div id="kt_project_overview_graph" class="card-rounded-bottom" style="height: 300px; min-height: 315px;">
            
        </div>
    </div>
</div>

<script>
    function generateData(count, yrange) {
        var i = 0;
        var series = [];
        while (i < count) {
            var x = 'W' + (i + 1).toString();
            var y = Math.floor(Math.random() * (yrange.max - yrange.min + 1)) + yrange.min;

            series.push({
                x: x,
                y: y
            });
            i++;
        }
        return series;
    }

    function handleGraphicsHeatmap(data) {
        console.log(data);

        var options = {
            series: [{
                    name: 'Minggu',
                    data: generateData(12, {
                        min: 0,
                        max: 90
                    })
                },
                {
                    name: 'Sabtu',
                    data: generateData(12, {
                        min: 0,
                        max: 90
                    })
                },
                {
                    name: 'Jumat',
                    data: generateData(12, {
                        min: 0,
                        max: 90
                    })
                },
                {
                    name: 'Kamis',
                    data: generateData(12, {
                        min: 0,
                        max: 90
                    })
                },
                {
                    name: "Rabu",
                    data: generateData(12, {
                        min: 0,
                        max: 90
                    })
                },
                {
                    name: 'Selasa',
                    data: generateData(12, {
                        min: 0,
                        max: 90
                    })
                },
                {
                    name: 'Senin',
                    data: generateData(12, {
                        min: 0,
                        max: 90
                    })
                },
            ],
            chart: {
                height: 350,
                type: 'heatmap',
            },
            yaxis: {
                type: 'category',
                categories: ['Senin', 'Selasa']
            },
            dataLabels: {
                enabled: false
            },
            colors: ["#7239EA"],
            title: {
                text: 'HeatMap Chart Project'
            },
        };

        var chart = new ApexCharts(document.querySelector("#kt_project_overview_graph"), options);
        chart.render();
    }

    $('#container-task-overtime').ready( async function () {
        const data = await $.ajax({
            url: "{{route('com.promag.detail.getTaskOverview', ['work_list_id' => $work_list_id])}}",
            type: 'GET',
        })

        handleGraphicsHeatmap(data.data);
    })

    
    
</script>