<?php

use App\Constants;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAllAssignment extends Migration
{
    private $constants;

    public function __construct()
    {
        $this->constants = new Constants();
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assignments', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->constrained("users");
            $table->foreignId("signed_by")->constrained("users");
            $table->string("number", 255)->unique();
            $table->date("start_date");
            $table->date("end_date");
            $table->boolean("override_holiday")->default(0);
            $table->string("name", 255);
            $table->string("location", 255);
            $table->string("latitude", 50);
            $table->string("longitude", 50);
            $table->time("working_start")->nullable();
            $table->time("working_end")->nullable();
            $table->integer("radius")->default(100000);
            $table->text("purpose");
            $table->enum("status", $this->constants->assignment_status)->default($this->constants->assignment_status[0]);
            $table->softDeletes()->index();
            $table->timestamps();
        });

        // Schema::create('assignment_file', function (Blueprint $table) {
        //     $table->id();
        //     $table->foreignId("assignment_id")->constrained("assignment");
        //     $table->string("location", 255);

        //     $table->softDeletes()->index();
        //     $table->timestamps();
        // });

        Schema::create('user_assignments', function (Blueprint $table) {
            $table->id();
            $table->foreignId("assignment_id")->constrained("assignments");
            $table->foreignId("user_id")->nullable()->constrained("users");
            $table->string("name", 255)->nullable();
            $table->string("position", 255)->nullable();
            $table->string("nik", 255)->nullable();
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
        Schema::dropIfExists('assignments');
        Schema::dropIfExists('user_assignments');
    }
}
