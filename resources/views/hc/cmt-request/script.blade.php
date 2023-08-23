@include('hc.cmt-request.attendance.script')
@include('hc.cmt-request.timeoff.script')
@include('hc.cmt-request.overtime.script')
@include('hc.cmt-request.shift.script')
@include('hc.cmt-request.delegate.script')

<script>
    $(document).ready(function () {
        attendanceInit();
    });
</script>
