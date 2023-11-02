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
    function generateDataRandom(count, yrange) {
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

    function generateData(count, dayData) {
        var i = 0;
        var series = [];
        while (i < count) {    
            const x = 'W' + (i + 1).toString();
            if (dayData) {
                const dataValue = dayData.filter(item => item.week_number == i+1)[0] ? dayData.filter(item => item.week_number == i+1)[0].total : 0;
                const y = dataValue;

                series.push({
                    x,
                    y
                });
                i++;
                continue;
            }
            series.push({
                x,
                y: 0,
            });
            i++;
            
        }
        return series;

        // const series = dayData.map((item, index) => {
        //     return {
        //         x: `W${item.week_number}`,
        //         y: item.total
        //     }
        // })
        
        // return series;
    }

    function handleGraphicsHeatmap(data) {
        const dataReal = data.data;

        var options = {
            series: [{
                    name: 'Sunday',
                    data: generateData(13, dataReal.Sunday)
                },
                {
                    name: 'Saturday',
                    data: generateData(13, dataReal.Saturday)
                },
                {
                    name: 'Friday',
                    data: generateData(13, dataReal.Friday)
                },
                {
                    name: 'Thursday',
                    data: generateData(13, dataReal.Thursday)
                },
                {
                    name: "Wednesday",
                    data: generateData(13, dataReal.Wednesday)
                },
                {
                    name: 'Tuesday',
                    data: generateData(13, dataReal.Tuesday)
                },
                {
                    name: 'Monday',
                    data: generateData(13, dataReal.Monday)
                },
            ],
            chart: {
                height: 350,
                type: 'heatmap',
            },
            xaxis: {
                type: 'category',
                categories: ['W1', 'W2', 'W3', 'W4','W5','W6','W7','W8','W9','W10','W11','W12','W13']
            },
            dataLabels: {
                enabled: true
            },
            tooltip: {
                custom: function({ series, seriesIndex, dataPointIndex, w }) {
                    const dataFromGraph = dataReal[options.series[seriesIndex].name][dataPointIndex];

                    return `
                    <div class="m-2"> 
                        <div class="px-5">
                            <span class="fs-7">${options.series[seriesIndex].name}, ${dataFromGraph.date}: </span> 
                            <div class="fs-7">
                                <ul>
                                    <li>
                                        <span class="fw-bold fs-6 m-0">${series[seriesIndex][dataPointIndex]}</span> Activity Reached
                                    </li>
                                </ul>
                            </div> 
                        </div>
                    </div>`;
                }
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