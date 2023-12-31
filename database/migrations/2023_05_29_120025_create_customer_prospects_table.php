<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerProspectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_prospects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained();
            $table->string('prospect_title');
            $table->softDeletes()->index();
            $table->timestamps();
        });

        Schema::create('customer_prospect_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_prospect_id')->constrained();
            $table->string('prospect_update');
            $table->string('prospect_next_action')->nullable();
            $table->dateTime('next_action_plan_date')->nullable()->index();
            $table->integer('status')->default(1)->index(); //1 prg 0 cancel 2 done
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
        Schema::dropIfExists('customer_prospect_logs');
        Schema::dropIfExists('customer_prospects');
    }
}
