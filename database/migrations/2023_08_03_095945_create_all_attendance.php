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
            $table->string("name", 100);
            $table->date("start_date");
            $table->date("end_date");
            $table->softDeletes()->index();
            $table->timestamps();
        });

        Schema::create('leave_request_categories', function (Blueprint $table) {
            $table->id();
            $table->string("name", 100)->unique();
            $table->string("code", 8)->unique();
            $table->date("effective_date");
            $table->boolean("attachment")->default(0);
            $table->boolean("show_in_request")->default(0);
            $table->tinyInteger("max_request")->nullable();
            $table->boolean("use_quota")->default(0);

            // use balance
            $table->boolean("unlimited_balance")->default(1);
            $table->tinyInteger("min_works")->default(12);
            $table->smallInteger("balance")->nullable();
            $table->enum("balance_type", $this->constants->balance_type)->default($this->constants->balance_type[0]);
            $table->boolean("expired")->default(0);
            $table->tinyInteger("carry_amount")->nullable();
            $table->tinyInteger("carry_expired")->nullable();

            // use time
            $table->boolean("half_day")->default(0);

            // use date
            $table->smallInteger("minus_amount")->nullable();
            $table->smallInteger("duration")->nullable();

            $table->softDeletes()->index();
            $table->timestamps();
        });

        Schema::create('user_leave_category_quotas', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->constrained("users");
            $table->foreignId("leave_request_category_id")->constrained("leave_request_categories");
            $table->smallInteger("quotas");
            $table->smallInteger("carry_quotas");
            $table->date("expire_date");
            $table->softDeletes()->index();
            $table->timestamps();
        });

        Schema::create('user_attendances', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->constrained("users");
            $table->date("date")->index();
            $table->enum("attendance_code", $this->constants->attendance_code)->default($this->constants->attendance_code[0])->index();
            $table->string("day_off_code", 10)->nullable();
            $table->string("shift_name", 40)->nullable();
            $table->time("working_start")->nullable()->index();
            $table->time("working_end")->nullable()->index();
            $table->string("primary_shift_name", 40)->nullable(); // primary is history of shift if the shift changed
            $table->time("primary_working_start")->nullable();
            $table->time("primary_working_end")->nullable();
            $table->boolean("shift_changed")->default(0);
            $table->time("overtime_before")->nullable();
            $table->time("overtime_after")->nullable();
            $table->tinyInteger("late_check_in")->default(0);
            $table->tinyInteger("late_check_out")->default(0);
            $table->smallInteger("start_attend")->nullable(); // in minute
            $table->smallInteger("end_attend")->nullable(); // in minute
            $table->integer("overtime")->default(0);
            $table->timestamp("check_in")->nullable();
            $table->timestamp("check_out")->nullable();
            $table->string("check_in_latitude", 50)->nullable();
            $table->string("check_in_longitude", 50)->nullable();
            $table->string("check_out_latitude", 50)->nullable();
            $table->string("check_out_longitude", 50)->nullable();
            $table->text("check_in_file")->nullable();
            $table->text("check_out_file")->nullable();
            $table->softDeletes()->index();
            $table->timestamps();
        });

        Schema::create('user_attendance_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->constrained("users");
            $table->foreignId("approval_line")->nullable()->constrained("users"); // approval_line as history (who change the status)
            $table->enum("status", $this->constants->approve_status)->default($this->constants->approve_status[0])->index();
            $table->date("date");
            $table->text("notes")->nullable();
            $table->text("comment")->nullable();
            $table->text("file")->nullable();
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

        Schema::create('user_leave_request_quota', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->constrained("users");
            $table->foreignId("leave_request_category_id")->constrained("leave_request_categories");
            $table->tinyInteger("quota");
            $table->date("expire_date");
            $table->softDeletes()->index();
            $table->timestamps();
        });

        Schema::create('user_leave_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->constrained("users");
            $table->foreignId("approval_line")->nullable()->constrained("users"); // approval_line as history (who change the status)
            $table->enum("status", $this->constants->approve_status)->default($this->constants->approve_status[0]);
            $table->foreignId("leave_request_category_id")->constrained("leave_request_categories");
            $table->text("notes")->nullable();
            $table->text("comment")->nullable();
            $table->text("file")->nullable();

            // use date
            $table->date("start_date")->nullable();
            $table->date("end_date")->nullable();
            $table->tinyInteger("taken")->nullable();

            // use time
            $table->time("working_start")->nullable();
            $table->time("working_end")->nullable();

            $table->softDeletes()->index();
            $table->timestamps();
        });

        Schema::create('user_leave_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->constrained("users");
            $table->string("leave_category", 60);
            $table->string("code", 10);
            $table->string("approval_line", 100);
            $table->date("date")->index();
            $table->boolean("quota_taken")->default(0);
            $table->softDeletes()->index();
            $table->timestamps();
        });

        Schema::create('user_overtime_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->constrained("users");
            $table->foreignId("approval_line")->nullable()->constrained("users"); // approval_line as history (who change the status)
            $table->enum("status", $this->constants->approve_status)->default($this->constants->approve_status[0]);
            $table->date("date");
            $table->time("overtime_before");
            $table->time("overtime_after");
            $table->time("break_start");
            $table->time("break_end");
            $table->text("notes")->nullable();
            $table->text("comment")->nullable();
            $table->softDeletes()->index();
            $table->timestamps();
        });

        Schema::create('user_shift_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->constrained("users");
            $table->foreignId("approval_line")->nullable()->constrained("users"); // approval_line as history (who change the status)
            $table->enum("status", $this->constants->approve_status)->default($this->constants->approve_status[0]);
            $table->foreignId("working_shift_id")->constrained("working_shifts");
            $table->date("date");
            $table->text("notes")->nullable();
            $table->text("comment")->nullable();
            $table->softDeletes()->index();
            $table->timestamps();
        });

        Schema::create('attendance_change_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->constrained("users");
            $table->foreignId("attendance_id")->constrained("user_attendances");
            $table->date("date")->index();
            $table->string("action", 30);
            $table->timestamp("old_check_in")->nullable();
            $table->timestamp("old_check_out")->nullable();
            $table->timestamp("new_check_in")->nullable();
            $table->timestamp("new_check_out")->nullable();
            $table->text("reason")->nullable();
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

        Schema::dropIfExists('attendance_change_logs');
    }
}
