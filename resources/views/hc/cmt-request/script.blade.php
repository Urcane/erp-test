<script>
    const formatDate = (date) => {
        const [year, month, day] = date.split("-");
        return `${day}/${month}/${year}`;
    }

    const formatDateTime = (dateTime) => {
        return dateTime === "-" ? "-" : dateTime.replace(" ", " at ");
    }

    const approveStatusEnum = @json($approveStatus);
</script>

@include('hc.cmt-request.attendance.script')
@include('hc.cmt-request.timeoff.script')
{{-- @include('hc.cmt-request.overtime.script') --}}
@include('hc.cmt-request.shift.script')
{{-- @include('hc.cmt-request.delegate.script') --}}

<script>
    $(document).ready(function() {
        attendanceInit();

        $('#timeoffnav').one('click', function() {
            timeOffInit();
        });

        $('#shiftnav').one('click', function() {
            shiftInit();
        });
    });
</script>
