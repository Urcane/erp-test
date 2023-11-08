@include('hc.cmt-settings.time-management.leave.user.script')
@include('hc.cmt-settings.time-management.leave.settings.script')

<script>
    $(document).ready(function () {
        settingInit();

        $('#usernav').one('click', function () {
            userInit();
        });
    });
</script>
