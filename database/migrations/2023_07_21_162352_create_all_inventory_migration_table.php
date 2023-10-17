<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAllInventoryMigrationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_unit_masters', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->string('code', 10)->unique();
            $table->softDeletes()->index();
            $table->timestamps();
        });

        Schema::create('inventory_good_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->string('code_name', 10)->unique();
            $table->softDeletes()->index();
            $table->timestamps();
        });

        Schema::create('inventory_goods', function (Blueprint $table) {
            $table->id();
            $table->foreignId('good_category_id')->constrained('inventory_good_categories');
            $table->string('good_name');
            $table->string('good_type')->nullable()->index();
            $table->string('code_name');
            $table->string('spesification')->nullable();
            $table->string('merk')->nullable()->index();
            $table->string('description')->nullable();
            $table->softDeletes()->index();
            $table->timestamps();
        });

        Schema::create('inventory_good_conditions', function (Blueprint $table) {
            $table->id();
            $table->string("name", 255);
            $table->softDeletes()->index();
            $table->timestamps();
        });

        Schema::create('inventory_good_statuses', function (Blueprint $table) {
            $table->id();
            $table->string("name", 255);
            $table->softDeletes()->index();
            $table->timestamps();
        });

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
            $table->string("serial_number", 255)->nullable()->index();
            $table->foreignId("warehouse_id")->constrained("warehouses");
            $table->foreignId("inventory_good_id")->constrained("inventory_goods");
            $table->foreignId("inventory_unit_master_id")->constrained("inventory_unit_masters");
            $table->integer("minimum_stock");
            $table->softDeletes()->index();
            $table->timestamps();
        });

        Schema::create('warehouse_good_stocks', function (Blueprint $table) {
            $table->id();
            $table->foreignId("warehouse_good_id")->constrained("warehouse_goods");
            $table->foreignId("inventory_good_condition_id")->constrained("inventory_good_conditions");
            $table->foreignId("inventory_good_status_id")->constrained("inventory_good_statuses");
            $table->unique(['warehouse_good_id', 'inventory_good_condition_id', 'inventory_good_status_id'], 'unique_warehouse_good_stocks');
            $table->integer("stock");
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
        Schema::dropIfExists('inventory_good_categories');
        Schema::dropIfExists('inventory_goods');
        Schema::dropIfExists('inventory_unit_masters');
        Schema::dropIfExists('warehouses');
        Schema::dropIfExists('warehouse_goods');
        Schema::dropIfExists('inventory_goods_condition');
    }
}
