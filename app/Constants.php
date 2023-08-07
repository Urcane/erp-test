<?php

namespace App;

class Constants
{
    // only database
    public $attendanceStatus = ["kerja", "libur", "cuti", "izin", "sakit"]; // [0] as default

    // database related
    public $maritalStatus = ["Belum Kawin", "Kawin", "Cerai Hidup", "Cerai Mati"];
    public $gender = ["Laki-laki", "Perempuan"];
    public $bloodType = ["A", "B", "AB", "O"];
    public $religion = ["Islam", "Kristen", "Buddha", "Hindu", "Konghucu", "Katolik", "Lainnya"];
    public $paymentType = ["Monthly", "Weekly"];
    public $day = ["Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu"];
    public $month = [
        "Januari", "Febuari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"
    ];
    public $salaryType = ["Weekly", "Monthly"];
    public $taxMethod = ["Gross", "Gross up", "Netto"];
    public $taxSalary = ["Taxable", "Non-taxable"];
    public $jaminanPensiunCost = ["Not paid", "By company", "By Employee"];
    public $grade = ["SD/MI", "SMP/MTs", "SMA/SMK/MA", "D1", "D2", "D3", "S1/D4", "S2", "S3"];

    // only view
    public $identityType = ["KTP", "SIM", "Passport"];
    public $bankName = [
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
}
