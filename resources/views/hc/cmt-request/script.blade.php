<script>
    const formatDate = (date) => {
        const [year, month, day] = date.split("-");
        return `${day}/${month}/${year}`;
    }

    const formatDateTime = (dateTime) => {
        return dateTime === "-" ? "-" : dateTime.replace(" ", " at ");
    }

    const calculateDateDifference = (startDateStr, endDateStr) => {
        const startDate = new Date(startDateStr);
        const endDate = new Date(endDateStr);

        const timeDifference = endDate.getTime() - startDate.getTime();
        const daysDifference = Math.floor(timeDifference / (1000 * 3600 * 24)) + 1;

        return daysDifference;
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
