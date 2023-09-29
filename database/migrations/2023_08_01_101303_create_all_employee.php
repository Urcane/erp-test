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
        Schema::create('branches', function (Blueprint $table) {
            $table->id();
            $table->string("industry", 40);
            $table->string("company_size", 40);
            $table->date("company_taxable_date");
            $table->string("head_office_initial", 40);
            $table->string("bpjs_ketenagakerjaan", 40);
            $table->string("jaminan_kecelakaan_kerja", 40);
            $table->softDeletes()->index();
            $table->timestamps();
        });

        Schema::create('sub_branches', function (Blueprint $table) {
            $table->id();
            $table->foreignId("branch_id")->nullable()->constrained("branches");
            $table->foreignId("parent_id")->nullable()->constrained("sub_branches");
            $table->string("name", 40);
            $table->string("phone_number", 15);
            $table->string("email", 40);
            $table->string("city", 30);
            $table->string("province", 30);
            $table->string("address", 30);
            $table->integer("umr")->nullable();
            $table->string("npwp", 20);
            $table->string("tax_name", 25);
            $table->string("tax_person_npwp", 25);
            $table->string("tax_person_name", 25);
            $table->string("klu", 15);
            $table->string("signature")->nullable();
            $table->string("logo")->nullable();
            $table->softDeletes()->index();
            $table->timestamps();
        });

        Schema::create('branch_locations', function (Blueprint $table) {
            $table->id();
            $table->foreignId("sub_branch_id")->nullable()->constrained("sub_branches");
            $table->string("latitude", 50);
            $table->string("longitude", 50);
            $table->integer("radius")->default(40); // meter
            $table->softDeletes()->index();
            $table->timestamps();
        });

        Schema::create('working_schedules', function (Blueprint $table) {
            $table->id();
            $table->string("name", 40);
            $table->date("effective_date");
            $table->boolean('override_national_holiday')->default(false);
            $table->boolean('override_company_holiday')->default(false);
            $table->boolean('override_special_holiday')->default(false);
            $table->softDeletes()->index();
            $table->timestamps();
        });

        Schema::create('working_shifts', function (Blueprint $table) {
            $table->id();
            $table->string("name", 40);
            $table->time("working_start")->nullable();
            $table->time("working_end")->nullable();
            $table->time("break_start")->nullable();
            $table->time("break_end")->nullable();
            $table->smallInteger("late_check_in")->nullable(); // in minute
            $table->smallInteger("late_check_out")->nullable(); // in minute
            $table->smallInteger("start_attend")->nullable(); // in minute
            $table->smallInteger("end_attend")->nullable(); // in minute
            $table->time("overtime_before")->nullable();
            $table->time("overtime_after")->nullable();
            $table->boolean("show_in_request")->default(0);
            $table->boolean("is_working")->default(1);
            $table->softDeletes()->index();
            $table->timestamps();
        });

        Schema::create('working_schedule_shifts', function (Blueprint $table) {
            $table->id();
            $table->foreignId("working_schedule_id")->constrained("working_schedules");
            $table->foreignId("working_shift_id")->constrained("working_shifts")->onUpdate('cascade');
            $table->integer("next")->index();
            $table->timestamps();
        });

        Schema::create('employment_statuses', function (Blueprint $table) {
            $table->id();
            $table->string("name", 40);
            $table->boolean('have_end_date')->nullable()->default(false);
            $table->softDeletes()->index();
            $table->timestamps();
        });

        Schema::create('payment_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId("parent_id")->nullable()->constrained("payment_schedules");
            $table->string("name", 40);
            $table->enum("payment_type", $this->constants->payment_type);
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

        Schema::create('tax_statuses', function (Blueprint $table) {
            $table->id();
            $table->string("name", 40);
            $table->softDeletes()->index();
            $table->timestamps();
        });

        Schema::create('user_file_categories', function (Blueprint $table) {
            $table->id();
            $table->string("name", 40);
            $table->softDeletes()->index();
            $table->timestamps();
        });

        Schema::create('user_files', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->constrained("users");
            $table->foreignId("user_file_category_id")->constrained("user_file_categories");
            $table->string("description", 40);
            $table->string("file", 40);
            $table->softDeletes()->index();
            $table->timestamps();
        });

        Schema::create('user_personal_data', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->constrained("users");
            $table->date("birthdate");
            $table->string("place_of_birth", 35)->nullable();
            $table->enum("marital_status", $this->constants->marital_status);
            $table->enum("gender", $this->constants->gender);
            $table->enum("blood_type", $this->constants->blood_type)->nullable();
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
            $table->string("citizen_id_address", 200)->nullable();
            $table->string("residential_address", 200)->nullable();
            $table->softDeletes()->index();
            $table->timestamps();
        });

        Schema::create('user_employment', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->constrained("users");
            $table->foreignId("employment_status_id")->constrained("employment_statuses");
            $table->string("employee_id", 35);
            $table->date("join_date");
            $table->date("end_date")->nullable()->default(null);
            $table->date("resign_date")->nullable()->default(null);
            $table->foreignId("sub_branch_id")->nullable()->constrained("sub_branches")->nullOnDelete();;
            $table->foreignId("working_schedule_id")->constrained("working_schedules");
            $table->string("start_shift");
            $table->foreignId("approval_line")->nullable()->constrained("users");
            $table->string("barcode")->nullable();
            $table->softDeletes()->index();
            $table->timestamps();
        });

        Schema::create('user_current_shifts', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->constrained("users");
            $table->foreignId("working_schedule_shift_id")->constrained("working_schedule_shifts");
            $table->timestamps();
        });

        Schema::create('user_salary', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->constrained("users");
            $table->bigInteger("basic_salary");
            $table->enum("salary_type", $this->constants->salary_type)->nullable();
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

        Schema::create('user_tax', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->constrained("users");
            $table->string("npwp", 18)->nullable();
            $table->string("pktp_status", 25);
            $table->enum("tax_method", $this->constants->tax_method)->nullable();
            $table->enum("tax_salary", $this->constants->tax_salary)->nullable();
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
            $table->enum("jaminan_pensiun_cost", $this->constants->jaminan_pensiun_cost)->nullable();
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
        Schema::dropIfExists('days');
        Schema::dropIfExists('working_schedule_day_off');
        Schema::dropIfExists('working_shifts');
        Schema::dropIfExists('working_schedules');
        Schema::dropIfExists('working_schedule_shifts');
        Schema::dropIfExists('employment_statuses');
        Schema::dropIfExists('payment_schedules');
        Schema::dropIfExists('prorate_settings');
        Schema::dropIfExists('tax_statuses');

        Schema::dropIfExists('user_personal_data');
        Schema::dropIfExists('user_identity');
        Schema::dropIfExists('user_employment');
        Schema::dropIfExists('user_salary');
        Schema::dropIfExists('user_bank');
        Schema::dropIfExists('user_tax');
        Schema::dropIfExists('branches');
        Schema::dropIfExists('sub_branches');
    }
}
