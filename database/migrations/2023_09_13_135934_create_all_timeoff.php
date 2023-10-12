<?php

use App\Constants;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAllTimeoff extends Migration
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
        Schema::create('leave_quota', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger("quotas");
            $table->tinyInteger("min_works");
            $table->tinyInteger("expired"); // Months
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
            $table->tinyInteger("min_notice")->default(0); // Minimal tanggal pengajuan cuti

            // use balance
            $table->boolean("unlimited_balance")->default(1);
            $table->tinyInteger("min_works")->default(0);
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
            $table->date("expired_date")->nullable()->index();
            $table->smallInteger("carry_quotas")->nullable();
            $table->date("carry_expired")->nullable();
            $table->softDeletes()->index();
            $table->timestamps();
        });

        Schema::create('user_leave_quotas', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->constrained("users");
            $table->tinyInteger("quotas");
            $table->date("expired_date")->index();
            $table->date("received_at"); // because the created_at dynamic
            $table->softDeletes()->index();
            $table->timestamps();
        });

        Schema::create('user_leave_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->constrained("users");
            $table->enum("type", $this->constants->leave_quota_history_type);
            $table->string("name", 100);
            $table->string("approval_name", 100);
            $table->string("date");
            $table->tinyInteger("quota_change")->default(0);
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
            $table->date("date")->nullable();
            $table->time("working_start")->nullable();
            $table->time("working_end")->nullable();

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
        Schema::dropIfExists('leave_request_categories');

        Schema::dropIfExists('user_leave_quotas');
        Schema::dropIfExists('user_leave_category_quotas');
        Schema::dropIfExists('user_leave_requests');
        Schema::dropIfExists('user_leave_histories');
    }
}
