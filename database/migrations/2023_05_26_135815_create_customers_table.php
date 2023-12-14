<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('city_id')->constrained();
            $table->foreignId('lead_reference_id')->constrained();
            $table->foreignId('bussines_type_id')->constrained();
            $table->integer('user_follow_up')->index()->nullable();
            $table->string('customer_name')->index();
            $table->string('customer_address')->index();
            $table->string('lat')->nullable();
            $table->string('lng')->nullable();
            $table->integer('prospect_status')->index()->nullable(); //0 batal, 1 prg, 2done
            $table->integer('customer_status')->index()->nullable(); //diupdate kalau PO masuk / eexsit customer
            $table->integer('approval_manager')->index()->nullable();
            $table->integer('status')->index()->default(1);
            $table->softDeletes()->index();
            $table->timestamps();
        });

        Schema::create("customer_bills", function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained();

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
        Schema::dropIfExists('customers');
    }
}
