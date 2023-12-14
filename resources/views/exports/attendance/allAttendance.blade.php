<table>
    <thead>
        <tr>
            <th>Log Absen Semua Karyawan</th>
        </tr>
        <tr></tr>
        <tr>
            <th>Tanggal</th>
            <th>{{ $rangeDate }}</th>
        </tr>
        <tr>
            <th>Divisi</th>
            <th>{{ $divisiName }}</th>
        </tr>
        <tr>
            <th>Department</th>
            <th>{{ $departmentName }}</th>
        </tr>
    </thead>
</table>

<table>
    <thead>
        <tr>
            <th>Summaries</th>
        </tr>

        <tr></tr>
        <tr>
            <th>TOTAL HADIR</th>
            <th>{{ $summaries[$constants->summaries_attendance[0]] + $summaries[$constants->summaries_attendance[1]] + $summaries[$constants->summaries_attendance[2]]}}</th>
            <th>Todal hadir pegawai (sudah melakukan checkin dan checkout)</th>
        </tr>

        <tr>
            <th>Detail Hadir</th>
        </tr>

        <tr>
            <th>{{ $constants->summaries_attendance[0] }}</th>
            <th>{{ $summaries[$constants->summaries_attendance[0]] }}</th>
            <th>{{ $constants->summaries_attendance_information[0] }}</th>
        </tr>

        <tr>
            <th>{{ $constants->summaries_attendance[1] }}</th>
            <th>{{ $summaries[$constants->summaries_attendance[1]] }}</th>
            <th>{{ $constants->summaries_attendance_information[1] }}</th>
        </tr>

        <tr>
            <th>{{ $constants->summaries_attendance[2] }}</th>
            <th>{{ $summaries[$constants->summaries_attendance[2]] }}</th>
            <th>{{ $constants->summaries_attendance_information[2] }}</th>
        </tr>

        <tr>
            <th></th>
        </tr>

        <tr>
            <th>TOTAL ABSEN</th>
            <th>{{ $summaries[$constants->summaries_attendance[3]] + $summaries[$constants->summaries_attendance[4]] + $summaries[$constants->summaries_attendance[5]]}}</th>
            <th>Total absen pegawai (antara tidak melakukan checkin/checkout)</th>
        </tr>

        <tr>
            <th>Detail Absen</th>
        </tr>

        <tr>
            <th>{{ $constants->summaries_attendance[3] }}</th>
            <th>{{ $summaries[$constants->summaries_attendance[3]] }}</th>
            <th>{{ $constants->summaries_attendance_information[3] }}</th>
        </tr>

        <tr>
            <th>{{ $constants->summaries_attendance[4] }}</th>
            <th>{{ $summaries[$constants->summaries_attendance[4]] }}</th>
            <th>{{ $constants->summaries_attendance_information[4] }}</th>
        </tr>

        <tr>
            <th>{{ $constants->summaries_attendance[5] }}</th>
            <th>{{ $summaries[$constants->summaries_attendance[5]] }}</th>
            <th>{{ $constants->summaries_attendance_information[5] }}</th>
        </tr>

        <tr>
            <th></th>
        </tr>

        <tr>
            <th>TOTAL IZIN/CUTI</th>
            <th>{{ $summaries[$constants->summaries_attendance[6]] + $summaries[$constants->summaries_attendance[7]] }}</th>
            <th>Total ijin/cuti yang diambil pegawai</th>
        </tr>

        <tr>
            <th>Detail Izin</th>
        </tr>

        <tr>
            <th>{{ $constants->summaries_attendance[6] }}</th>
            <th>{{ $summaries[$constants->summaries_attendance[6]] }}</th>
            <th>{{ $constants->summaries_attendance_information[6] }}</th>
        </tr>

        <tr>
            <th>{{ $constants->summaries_attendance[7] }}</th>
            <th>{{ $summaries[$constants->summaries_attendance[7]] }}</th>
            <th>{{ $constants->summaries_attendance_information[7] }}</th>
        </tr>

        <tr>
            <th></th>
        </tr>

        <tr>
            <th>TOTAL DINAS</th>
            <th>{{ $summaries[$constants->summaries_attendance[8]] + $summaries[$constants->summaries_attendance[9]] }}</th>
            <th>Total dinas yang diambil pegawai</th>
        </tr>

        <tr>
            <th>Detail dinas</th>
        </tr>

        <tr>
            <th>{{ $constants->summaries_attendance[6] }}</th>
            <th>{{ $summaries[$constants->summaries_attendance[6]] }}</th>
            <th>{{ $constants->summaries_attendance_information[6] }}</th>
        </tr>

        <tr>
            <th>{{ $constants->summaries_attendance[7] }}</th>
            <th>{{ $summaries[$constants->summaries_attendance[7]] }}</th>
            <th>{{ $constants->summaries_attendance_information[7] }}</th>
        </tr>

        {{-- @for ($i = 0; $i < count($constants->summaries_attendance); $i++)
            <tr>
                <th>{{ $constants->summaries_attendance[$i] }}</th>
                <th>{{ $summaries[$constants->summaries_attendance[$i]] }}</th>
                <th></th>
                <th>{{ $constants->summaries_attendance_information[$i] }}</th>
            </tr>
        @endfor --}}
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
            <th>Nama Pegawai</th>
            <th>NIP</th>
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
                <td>{{ $userAttendance->user->name }}</td>
                <td>'{{ $userAttendance->user->userEmployment->employee_id }}</td>
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
