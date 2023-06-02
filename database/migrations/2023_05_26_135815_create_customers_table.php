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
            $table->integer('user_follow_up')->nullable();
            $table->string('customer_name');
            $table->string('customer_address');
            $table->string('lat')->nullable();
            $table->string('lng')->nullable();
            $table->integer('prospect_status')->nullable(); //0 batal, 1 prg, 2done
            $table->integer('customer_status')->nullable(); //diupdate kalau PO masuk / eexsit customer
            $table->integer('approval_manager')->nullable();
            $table->integer('status')->default(1);
            $table->softDeletes();
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
