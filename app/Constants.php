<?php

namespace App;

class Constants
{
    // system
    public string $locale = "id";

    // database only
    public $attendance_code = [
        "work_day",     // Regular working day
        "leave",         // Leaves including personal, sick, etc.
        "off_schedule", // Day not on working schedule
        "holiday",      // Public or company-recognized holiday
        "assigned",     // Assigned by supervisor
    ]; // [0] as default, [1] always be for personal, sick, etc

    // database related
    public $marital_status = ["Belum Kawin", "Kawin", "Cerai Hidup", "Cerai Mati"];
    public $gender = ["Laki-laki", "Perempuan"];
    public $blood_type = ["A", "B", "AB", "O"];
    public $religion = ["Islam", "Kristen", "Buddha", "Hindu", "Konghucu", "Katolik", "Lainnya"];
    public $payment_type = ["Monthly", "Weekly"];
    public $day = ["Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu"]; //change the $locale if u wanna change the day language
    public $month = [
        "Januari", "Febuari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"
    ];
    public $salary_type = ["Weekly", "Monthly"];
    public $tax_method = ["Gross", "Gross up", "Netto"];
    public $tax_salary = ["Taxable", "Non-taxable"];
    public $jaminan_pensiun_cost = ["Not paid", "By company", "By Employee"];
    public $grade = ["SD/MI", "SMP/MTs", "SMA/SMK/MA", "D1", "D2", "D3", "S1/D4", "S2", "S3"];
    public $approve_status = ["Waiting", "Approved", "Rejected", "Canceled"]; // [0] as default // used manually on hc/request/* -> summaries and script
    public $balance_type = ["Anniversary", "Monthly"];
    public $leave_quota_history_type = ["minus", "plus"];
    public $assignment_status = ["Waiting", "Approved", "Rejected", "Canceled", "Expired"]; // [0] as default

    // system and view
    public $filter_status_attendance = [
        "On Time",
        "Late Check In",
        "Early Check Out",
        "No Check In",
        "No Check Out",
        "Hari Libur",
        "Izin/Cuti"
    ];

    // export excel
    public $summaries_attendance = [
        "On Time",
        "Late Check In",
        "Early Check Out",
        "Absent",
        "No Check In",
        "No Check Out",
        "Day Off",
        "Time Off"
    ];

    public $summaries_attendance_information = [
        "Tepat waktu dalam check-in dan check-out",
        "Terlambat check-in",
        "Terlalu cepat check-out",
        "Antara tidak check-in atau check-out",
        "Tidak check-in",
        "Tidak check-out",
        "Hari libur kerja/nasional",
        "Izin dan cuti"
    ];

    // only view
    public $identity_type = ["KTP", "SIM", "Passport"];
    public $bank_name = [
        "Bank Mandiri",
        "Bank Rakyat Indonesia (BRI)",
        "Bank Central Asia (BCA)",
        "Bank Negara Indonesia (BNI)",
        "Bank Tabungan Negara (BTN)",
        "CIMB Niaga",
        "Bank Syariah Indonesia (BSI)",
        "Permata Bank",
        "OCBC NISP",
        "Panin Bank",
    ];
    public $class = [
        "Class 1",
        "Class 2",
        "Class 3",
    ];
    public $overtime_working_day = [
        "Default 1",
        "Default 2",
        "Default 3",
    ];
    public $overtime_day_off = [
        "Default 1",
        "Default 2",
        "Default 3",
    ];
    public $overtime_national_holiday = [
        "Default 1",
        "Default 2",
        "Default 3",
    ];
    public $pktp  = [
        "PKTP Status 1",
        "PKTP Status 2",
        "PKTP Status 3",
    ];
    public $ketenagakerjaan_npp = [
        "NPP 1",
        "NPP 2",
        "NPP 3",
    ];
    public $kesehatan_family = [
        "Family 1",
        "Family 2",
        "Family 3",
    ];
    public $kesehatan_cost = [
        "Cost 1",
        "Cost 2",
        "Cost 3",
    ];
    public $jht_cost = [
        "JHT Cost 1",
        "JHT Cost 2",
        "JHT Cost 3",
    ];

    public $attendance_code_view = [
        "Kerja", // Regular working day
        "Izin/Cuti", // Leaves including personal, sick, etc.
        "Libur Kerja", // Day not on working schedule
        "Hari Libur", // Public or company-recognized holiday
        "Dinas", // Assigned by supervisor
    ];

    public function attendanceCodeTranslator($code)
    {
        $index = array_search($code, $this->attendance_code);

        if ($index !== false && isset($this->attendance_code_view[$index])) {
            return $this->attendance_code_view[$index];
        }

        return null;
    }
}
