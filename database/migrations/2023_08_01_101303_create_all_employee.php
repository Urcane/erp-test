<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAllEmployee extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_personal_data', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->constrained("users");
            $table->date("birthdate");
            $table->string("place_of_birth", 35)->nullable();
            $table->enum("marital_status", ["Belum Kawin", "Kawin", "Cerai Hidup", "Cerai Mati"]);
            $table->enum("gender", ["Laki-laki", "Perempuan"]);
            $table->enum("blood_type", ["A", "B", "AB", "O"])->nullable();
            $table->enum("religion", ["Islam", "Kristen", "Buddha", "Hindu", "Konghucu", "Katolik"]);
            $table->softDeletes()->index();
            $table->timestamps();
        });

        Schema::create('user_identity', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->constrained("users");
            $table->string("type", 10)->nullable();
            $table->integer("number")->nullable();
            $table->date("expire_date")->nullable(); //null jika permanent
            $table->string("postal_code", 6)->nullable();
            $table->string("citizen_id_address", 100)->nullable();
            $table->string("residential_address", 100)->nullable();
            $table->softDeletes()->index();
            $table->timestamps();
        });

        Schema::create('user_employment', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->constrained("users");
            $table->bigInteger("employee_id");
            $table->string("status", 25);
            $table->date("join_date");
            $table->date("end_date")->nullable()->default(null);
            $table->date("resign_date")->nullable()->default(null);
            $table->enum("branch", ["Pusat", "Cabang"])->nullable();
            $table->string("organization", 35);
            $table->string("job_position", 35);
            $table->string("job_level", 35);
            $table->string("grade", 40);
            $table->string("class", 40);
            $table->string("schedule", 40);
            $table->string("approval_line", 30)->nullable();
            $table->string("barcode")->nullable();
            $table->softDeletes()->index();
            $table->timestamps();
        });

        Schema::create('user_salary', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->constrained("users");
            $table->integer("basic_salary");
            $table->enum("salary_type", ["Monthly", "Yearly"])->nullable();
            $table->string("payment_schedule", 25)->nullable();
            $table->string("prorate_setting", 40)->nullable();
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
            $table->string("name", 20);
            $table->string("number", 20);
            $table->string("holder_name", 35);
            $table->softDeletes()->index();
            $table->timestamps();
        });

        Schema::create('user_tax', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->constrained("users");
            $table->string("npwp", 18)->nullable();
            $table->string("pktp_status", 25);
            $table->enum("tax_method", ["lorem", "lorem2"])->nullable();
            $table->enum("tax_salary", ["lorem", "lorem2"])->nullable();
            $table->date("taxable_date")->nullable();
            $table->enum("tax_status", ["lorem", "lorem2"])->nullable();
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
            $table->string("jaminan_pensiun_cost", 20)->nullable();
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
        Schema::dropIfExists('user_bpjs');
    }
}
