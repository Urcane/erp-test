<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemablePriceRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('itemable_price_requests', function (Blueprint $table) {
            $table->id();
            $table->integer('survey_id')->nullable();
            $table->integer('work_list_id')->nullable();
            $table->string('customer_contact_id');
            $table->string('customer_company_id');
            $table->string('no_ph')->nullable();
            $table->string('release_date')->nullable();
            $table->string('reference_price_request_id')->nullable()->digits(4);
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
        Schema::dropIfExists('itemable_price_requests');
    }
}
