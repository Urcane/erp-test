<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Constants;

class CreateAllPersonalInfo extends Migration
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
        Schema::create('user_families', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->constrained("users");
            $table->string("name", 45);
            $table->string("relationship", 20);
            $table->date("birthday");
            $table->string("nik", 17);
            $table->enum("marital_status", $this->constants->marital_status);
            $table->enum("gender", $this->constants->gender);
            $table->string("job", 50);
            $table->enum("religion", $this->constants->religion);
            $table->softDeletes()->index();
            $table->timestamps();
        });

        Schema::create('user_emergency_contacts', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->constrained("users");
            $table->string("name", 45);
            $table->string("relationship", 20);
            $table->string("phone", 20);
            $table->softDeletes()->index();
            $table->timestamps();
        });

        Schema::create('user_formal_educations', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->constrained("users");
            $table->string("name", 50);
            $table->enum("grade", $this->constants->grade);
            $table->string("major", 40);
            $table->tinyInteger("start_year");
            $table->tinyInteger("end_year");
            $table->string("score", 8);
            $table->text("certificate")->nullable();
            $table->softDeletes()->index();
            $table->timestamps();
        });

        Schema::create('non_formal_education_categories', function (Blueprint $table) {
            $table->id();
            $table->string("name", 45);
            $table->softDeletes()->index();
            $table->timestamps();
        });

        Schema::create('user_non_formal_educations', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->constrained("users");
            $table->foreignId("category_id")->constrained("non_formal_education_categories");
            $table->string("name", 50);
            $table->string("held_by", 35);
            $table->date("expired_date")->nullable(); //null jika permanent
            $table->tinyInteger("start_year");
            $table->tinyInteger("end_year");
            $table->tinyInteger("duration"); // by day
            $table->integer("fee");
            $table->text("certificate")->nullable();
            $table->softDeletes()->index();
            $table->timestamps();
        });

        Schema::create('user_working_experiences', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->constrained("users");
            $table->string("name", 50);
            $table->string("position", 50);
            $table->date("start_day");
            $table->date("end_day")->nullable(); //null jika masih bekerja
            $table->softDeletes()->index();
            $table->timestamps();
        });

        Schema::create('user_additional_informations', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->constrained("users");
            $table->foreignId("author_id")->constrained("users");
            $table->text("comment");
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
        Schema::dropIfExists('user_families');
        Schema::dropIfExists('user_emergency_contacts');
        Schema::dropIfExists('user_formal_educations');
        Schema::dropIfExists('user_non_formal_educations');
        Schema::dropIfExists('user_working_experiences');
        Schema::dropIfExists('user_additional_information');
    }
}
