<table>
    <thead>
        <tr>
            <th>Log Absen {{ $user->name }} {{ $user->userEmployment->employee_id }}</th>
        </tr>
        <tr></tr>
        <tr>
            <th>Tanggal</th>
            <th>{{ $rangeDate }}</th>
        </tr>
        <tr>
            <th>Divisi</th>
            <th>{{ $user->division->divisi_name }}</th>
        </tr>
        <tr>
            <th>Department</th>
            <th>{{ $user->department->department_name }}</th>
        </tr>
    </thead>
</table>

<table>
    <thead>
        <tr>
            <th>Summaries</th>
        </tr>
        <tr></tr>
        @for ($i = 0; $i < count($constants->summaries_attendance); $i++)
            <tr>
                <th>{{ $constants->summaries_attendance[$i] }}</th>
                <th>{{ $summaries[$constants->summaries_attendance[$i]] }}</th>
                <th></th>
                <th>{{ $constants->summaries_attendance_information[$i] }}</th>
            </tr>
        @endfor
    </thead>
</table>

<table>
    <thead>
        <tr>
            <th>Attendance Logs</th>
        </tr>
    </thead>
</table>

<table>
    <thead>
        <tr>
            <th>Date</th>
            <th>Shift</th>
            <th>Schedule In</th>
            <th>Schedule Out</th>
            <th>Clock In</th>
            <th>Clock Out</th>
            <th>Overtime</th>
            <th>Attendance Code</th>
            <th>Time Off Code</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($userAttendances as $userAttendance)
            <tr>
                <td>{{ $userAttendance->date }}</td>
                <td>{{ $userAttendance->shift_name ?? '-' }}</td>
                <td>{{ $userAttendance->working_start ?? '-' }}</td>
                <td>{{ $userAttendance->working_end ?? '-' }}</td>

                @if ($userAttendance->check_in)
                    <td>{{ date('H:i', strtotime($userAttendance->check_in)) }}</td>
                @else
                    <td>-</td>
                @endif

                @if ($userAttendance->check_out)
                    <td>{{ date('H:i', strtotime($userAttendance->check_out)) }}</td>
                @else
                    <td>-</td>
                @endif

                @if ($userAttendance->overtime != 0)
                    <td>{{ $userAttendance->overtime }}</td>
                @else
                    <td>-</td>
                @endif

                <td>{{ $constants->attendanceCodeTranslator($userAttendance->attendance_code) ?? '-' }}</td>
                <td>{{ $userAttendance->day_off_code ?? '-' }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
