<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePdItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pd_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pd_id')->constrained();
            $table->string('pd_item');
            $table->string('pd_item_desc');
            $table->integer('item_price')->default(0);
            $table->integer('item_qty')->default(0);
            $table->integer('item_duration')->default(0);
            $table->integer('itam_total')->default(0);
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
        Schema::dropIfExists('pd_items');
    }
}
