<script src="{{ asset('sense/plugins/custom/leaflet/leaflet.bundle.js') }}"></script>
<script src="https://unpkg.com/leaflet-geosearch@3.8.0/dist/geosearch.umd.js"></script>

@include('finance.inventory.master-data.warehouse.script')
@include('finance.inventory.master-data.item.script')
@include('finance.inventory.master-data.category.script')
@include('finance.inventory.master-data.unit.script')
@include('finance.inventory.master-data.condition.script')
@include('finance.inventory.master-data.status.script')

<script>
    $(document).ready(function() {
        warehouseInit();

        $('#itemnav').one('click', function() {
            itemInit();
        });

        $('#categorynav').one('click', function() {
            categoryInit();
        });

        $('#unitnav').one('click', function() {
            unitInit();
        });

        $('#conditionnav').one('click', function() {
            conditionInit();
        });

        $('#statusnav').one('click', function() {
            statusInit();
        });
    });
</script>
