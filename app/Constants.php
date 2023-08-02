<?php

namespace App;

class Constants
{
    public $maritalStatus = ["Belum Kawin", "Kawin", "Cerai Hidup", "Cerai Mati"];
    public $gender = ["Laki-laki", "Perempuan"];
    public $bloodType = ["A", "B", "AB", "O"];
    public $religion = ["Islam", "Kristen", "Buddha", "Hindu", "Konghucu", "Katolik"];
    public $paymentType = ["Monthly", "Weekly"];
    public $day = ["Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu"];
    public $month = [
        "Januari", "Febuari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"
    ];
    public $salaryType = ["Weekly", "Monthly"];
    public $taxMethod = ["Gross", "Gross up", "Netto"];
    public $taxSalary = ["Taxable", "Non-taxable"];
    public $jaminanPensiunCost = ["Not paid", "By company", "By Employee"];
}
