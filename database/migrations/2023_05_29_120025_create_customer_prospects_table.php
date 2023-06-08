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
            $table->string('prospect_update');
            $table->string('prospect_next_action')->nullable();
            $table->integer('status')->index()->default(1); //1 prg 0 cancel 2 done
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
        Schema::dropIfExists('customer_prospects');
    }
}
