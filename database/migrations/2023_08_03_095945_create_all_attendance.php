<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Constants;

class CreateAllAttendance extends Migration
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
        Schema::create('global_day_offs', function (Blueprint $table) {
            $table->id();
            $table->string("name", 40);
            $table->date("date")->unique();
            $table->softDeletes()->index();
            $table->timestamps();
        });

        Schema::create('leave_request_categories', function (Blueprint $table) {
            $table->id();
            $table->string("name", 60);
            $table->string("code", 8);
            $table->tinyInteger("leave_quota_reduction")->default(0);
            $table->softDeletes()->index();
            $table->timestamps();
        });

        Schema::create('user_attendances', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->constrained("users");
            $table->date("date");
            $table->enum("status", $this->constants->attendanceStatus)->default($this->constants->attendanceStatus[0]);
            $table->time("working_start_time");
            $table->time("working_end_time");
            $table->timestamp("check_in")->nullable();
            $table->timestamp("check_out")->nullable();
            $table->softDeletes()->index();
            $table->timestamps();
        });

        Schema::create('user_attendance_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->constrained("users");
            $table->foreignId("approved_by")->nullable()->constrained("users");
            $table->date("date");
            $table->text("notes")->nullable();
            $table->timestamp("check_in")->nullable();
            $table->timestamp("check_out")->nullable();
            $table->softDeletes()->index();
            $table->timestamps();
        });

        Schema::create('user_leave_quotas', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->constrained("users");
            $table->tinyInteger("leave_quota");
            $table->timestamps();
        });

        Schema::create('user_leave_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->constrained("users");
            $table->foreignId("approved_by")->nullable()->constrained("users");
            $table->foreignId("leave_request_category_id")->constrained("leave_request_categories");
            $table->date("start_date");
            $table->date("end_date");
            $table->text("notes")->nullable();
            $table->text("file")->nullable();
            $table->softDeletes()->index();
            $table->timestamps();
        });

        Schema::create('user_leave_quota_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->constrained("users");
            $table->string("leave_category", 60);
            $table->string("approved_by", 100);
            $table->tinyInteger("leave_quota_taken");
            $table->date("start_date");
            $table->date("end_date");
            $table->softDeletes()->index();
            $table->timestamps();
        });

        Schema::create('user_overtime_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->constrained("users");
            $table->foreignId("approved_by")->nullable()->constrained("users");
            $table->date("date");
            $table->time("overtime_before");
            $table->time("overtime_after");
            $table->time("break_start");
            $table->time("break_end");
            $table->text("notes")->nullable();
            $table->softDeletes()->index();
            $table->timestamps();
        });

        Schema::create('user_shift_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->constrained("users");
            $table->foreignId("approved_by")->nullable()->constrained("users");
            $table->foreignId("working_shift_id")->constrained("working_shifts");
            $table->date("date");
            $table->text("notes")->nullable();
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
        Schema::dropIfExists('global_day_offs');
        Schema::dropIfExists('leave_request_categories');

        Schema::dropIfExists('user_attendances');
        Schema::dropIfExists('user_leave_quotas');
        Schema::dropIfExists('user_leave_requests');
        Schema::dropIfExists('user_leave_quota_histories');
        Schema::dropIfExists('user_overtime_requests');
        Schema::dropIfExists('user_shift_requests');
        Schema::dropIfExists('user_attendance_requests');
    }
}