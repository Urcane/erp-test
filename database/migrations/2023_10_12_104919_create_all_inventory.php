<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAllInventory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('warehouses', function (Blueprint $table) {
            $table->id();
            $table->string("name", 255);
            $table->string("latitude", 50)->nullable();
            $table->string("longitude", 50)->nullable();
            $table->softDeletes()->index();
            $table->timestamps();
        });

        Schema::create('warehouse_goods', function (Blueprint $table) {
            $table->id();
            $table->foreignId("warehouse_id")->constrained("warehouses");
            $table->foreignId("inventory_good_id")->constrained("inventory_goods");
            $table->foreignId("inventory_unit_master_id")->constrained("inventory_unit_masters");
            $table->string("name", 255);
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
        Schema::dropIfExists('warehouses');
        Schema::dropIfExists('warehouse_goods');
    }
}
