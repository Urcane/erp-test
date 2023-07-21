<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemableQuotationPartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('itemable_quotation_parts', function (Blueprint $table) {
            $table->id();
            $table->string('no_quotation');
            $table->string('description');
            $table->bigInteger('total_price')->digits(20);
            $table->string('referenced_quotation_id');
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
        Schema::dropIfExists('itemable_quotation_parts');
    }
}
