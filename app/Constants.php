<?php

namespace App;

class Constants
{
    // database related
    public $marital_status = ["Belum Kawin", "Kawin", "Cerai Hidup", "Cerai Mati"];
    public $gender = ["Laki-laki", "Perempuan"];
    public $blood_type = ["A", "B", "AB", "O"];
    public $religion = ["Islam", "Kristen", "Buddha", "Hindu", "Konghucu", "Katolik"];
    public $payment_type = ["Monthly", "Weekly"];
    public $day = ["Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu"];
    public $month = [
        "Januari", "Febuari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"
    ];
    public $salary_type = ["Weekly", "Monthly"];
    public $tax_method = ["Gross", "Gross up", "Netto"];
    public $tax_salary = ["Taxable", "Non-taxable"];
    public $jaminan_pensiun_cost = ["Not paid", "By company", "By Employee"];
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
}
