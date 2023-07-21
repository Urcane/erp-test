<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->integer('itemable_id');
            $table->string('itemable_type')->nullable();
            $table->string('item_inventory_id')->nullable();
            $table->string('item_detail')->nullable();
            $table->string('quantity')->nullable();
            $table->string('purchase_price')->nullable();
            $table->string('purchase_delivery_charge')->nullable();
            $table->string('purchase_refrence')->nullable();
            $table->boolean('process_status')->nullable();
            $table->boolean('is_monthly')->nullable();
            $table->boolean('vendor_charge')->nullable();
            $table->boolean('approval_manager')->nullable();
            $table->date('approval_manager_date')->nullable();
            $table->boolean('approval_director')->nullable();
            $table->date('approval_directo_dater')->nullable();
            $table->boolean('approval_finman')->nullable();
            $table->date('approval_finman_date')->nullable();
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
        Schema::dropIfExists('items');
    }
}
