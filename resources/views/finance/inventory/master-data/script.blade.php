<script>

</script>

@include('finance.inventory.master-data.warehouse.script')
@include('finance.inventory.master-data.category.script')
@include('finance.inventory.master-data.unit.script')
@include('finance.inventory.master-data.condition.script')
@include('finance.inventory.master-data.status.script')

<script>
    $(document).ready(function() {
        warehouseInit();

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
