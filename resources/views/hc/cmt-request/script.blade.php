<script>
    const formatDate = (date) => {
        const [year, month, day] = date.split("-");
        return `${day}/${month}/${year}`;
    }

    const approveStatusEnum = @json($approveStatus);
</script>

@include('hc.cmt-request.attendance.script')
@include('hc.cmt-request.timeoff.script')
@include('hc.cmt-request.overtime.script')
@include('hc.cmt-request.shift.script')
@include('hc.cmt-request.delegate.script')

<script>
    $(document).ready(function() {
        attendanceInit();
    });
</script>
