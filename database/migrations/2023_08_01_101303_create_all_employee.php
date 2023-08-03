<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Constants;

class CreateAllEmployee extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    private $constants;

    public function __construct()
    {
        $this->constants = new Constants();
    }

    public function up()
    {
        Schema::create('user_personal_data', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->constrained("users");
            $table->date("birthdate");
            $table->string("place_of_birth", 35)->nullable();
            $table->enum("marital_status", $this->constants->maritalStatus);
            $table->enum("gender", $this->constants->gender);
            $table->enum("blood_type", $this->constants->bloodType)->nullable();
            $table->enum("religion", $this->constants->religion);
            $table->softDeletes()->index();
            $table->timestamps();
        });

        Schema::create('user_identity', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->constrained("users");
            $table->string("type", 10)->nullable();
            $table->string("number", 25)->nullable();
            $table->date("expire_date")->nullable(); //null jika permanent
            $table->string("postal_code", 6)->nullable();
            $table->string("citizen_id_address", 100)->nullable();
            $table->string("residential_address", 100)->nullable();
            $table->softDeletes()->index();
            $table->timestamps();
        });

        Schema::create('branches', function (Blueprint $table) {
            $table->id();
            $table->string("name", 40);
            $table->softDeletes()->index();
            $table->timestamps();
        });

        Schema::create('job_positions', function (Blueprint $table) {
            $table->id();
            $table->foreignId("parent_id")->nullable()->constrained("job_positions");
            $table->string("name", 40);
            $table->softDeletes()->index();
            $table->timestamps();
        });

        Schema::create('job_levels', function (Blueprint $table) {
            $table->id();
            $table->string("name", 40);
            $table->softDeletes()->index();
            $table->timestamps();
        });

        Schema::create('working_schedules', function (Blueprint $table) {
            $table->id();
            $table->string("name", 40);
            $table->time("working_start_time");
            $table->time("working_end_time");
            $table->time("break_start_time");
            $table->time("break_end_time");
            $table->time("overtime_before")->nullable();
            $table->time("overtime_after")->nullable();
            $table->softDeletes()->index();
            $table->timestamps();
        });

        Schema::create('employment_statuses', function (Blueprint $table) {
            $table->id();
            $table->string("name", 40);
            $table->softDeletes()->index();
            $table->timestamps();
        });

        Schema::create('user_employment', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->constrained("users");
            $table->string("employee_id", 35);
            $table->foreignId("employment_status_id")->constrained("employment_statuses");
            $table->date("join_date");
            $table->date("end_date")->nullable()->default(null);
            $table->date("resign_date")->nullable()->default(null);
            $table->foreignId("branch_id")->nullable()->constrained("branches");
            $table->foreignId("job_position_id")->constrained("job_positions");
            $table->foreignId("job_level_id")->constrained("job_levels");
            $table->string("grade", 40);
            $table->string("class", 40);
            $table->foreignId("working_schedule_id")->constrained("working_schedules");
            $table->foreignId("approval_line")->nullable()->constrained("users");
            $table->string("barcode")->nullable();
            $table->softDeletes()->index();
            $table->timestamps();
        });

        Schema::create('payment_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId("parent_id")->nullable()->constrained("payment_schedules");
            $table->string("name", 40);
            $table->enum("payment_type", $this->constants->paymentType);
            $table->tinyInteger("payroll_date");
            $table->boolean("tax_with_salary");
            // Monthly
            $table->tinyInteger("attendance_date_start")->nullable();
            $table->tinyInteger("attendance_date_end")->nullable();
            $table->tinyInteger("payroll_date_start")->nullable();
            $table->tinyInteger("payroll_date_end")->nullable();
            $table->boolean("pay_last_month")->nullable();
            // Weekly
            $table->date("start_date")->nullable();
            $table->enum("cutoff_day", $this->constants->day)->nullable();
            $table->softDeletes()->index();
            $table->timestamps();
        });

        Schema::create('prorate_settings', function (Blueprint $table) {
            $table->id();
            $table->string("name", 40);
            $table->integer("custom_number")->nullable();
            $table->boolean("holiday_as_working_day")->default(0);
            $table->softDeletes()->index();
            $table->timestamps();
        });

        Schema::create('user_salary', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->constrained("users");
            $table->integer("basic_salary");
            $table->enum("salary_type", $this->constants->salaryType)->nullable();
            $table->foreignId("payment_schedule_id")->nullable()->constrained("payment_schedules");
            $table->foreignId("prorate_setting_id")->nullable()->constrained("prorate_settings");
            $table->boolean("allow_for_overtime")->default(0);
            $table->string("overtime_working_day", 10)->nullable();
            $table->string("overtime_day_off", 10)->nullable();
            $table->string("overtime_national_holiday", 10)->nullable();
            $table->softDeletes()->index();
            $table->timestamps();
        });

        Schema::create('user_bank', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->constrained("users");
            $table->string("name", 55)->nullable();
            $table->string("number", 20)->nullable();
            $table->string("holder_name", 35)->nullable();
            $table->softDeletes()->index();
            $table->timestamps();
        });

        Schema::create('tax_statuses', function (Blueprint $table) {
            $table->id();
            $table->string("name", 40);
            $table->softDeletes()->index();
            $table->timestamps();
        });

        Schema::create('user_tax', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->constrained("users");
            $table->string("npwp", 18)->nullable();
            $table->string("pktp_status", 25);
            $table->enum("tax_method", $this->constants->taxMethod)->nullable();
            $table->enum("tax_salary", $this->constants->taxSalary)->nullable();
            $table->date("taxable_date")->nullable();
            $table->foreignId("tax_status_id")->nullable()->constrained("tax_statuses");
            $table->integer("beginning_netto")->nullable();
            $table->integer("pph21_paid")->nullable();
            $table->softDeletes()->index();
            $table->timestamps();
        });

        Schema::create('user_bpjs', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->constrained("users");
            $table->string("ketenagakerjaan_number", 12)->nullable();
            $table->string("ketenagakerjaan_npp", 15)->nullable();
            $table->date("ketenagakerjaan_date")->nullable();
            $table->string("kesehatan_number", 14)->nullable();
            $table->string("kesehatan_family", 20)->nullable();
            $table->date("kesehatan_date")->nullable();
            $table->string("kesehatan_cost", 20)->nullable();
            $table->string("jht_cost", 20)->nullable();
            $table->enum("jaminan_pensiun_cost", $this->constants->jaminanPensiunCost)->nullable();
            $table->date("jaminan_pensiun_date")->nullable();
            $table->softDeletes()->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_personal_data');
        Schema::dropIfExists('user_identity');
        Schema::dropIfExists('user_employment');
        Schema::dropIfExists('user_salary');
        Schema::dropIfExists('user_bank');
        Schema::dropIfExists('user_tax');
        Schema::dropIfExists('branches');
        Schema::dropIfExists('job_positions');
        Schema::dropIfExists('job_levels');
        Schema::dropIfExists('working_schedules');
        Schema::dropIfExists('employment_statuses');
        Schema::dropIfExists('payment_schedules');
        Schema::dropIfExists('prorate_settings');
        Schema::dropIfExists('tax_statuses');
    }
}
