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
            $table->char('code', 10)->unique();
            $table->softDeletes()->index();
            $table->timestamps();
        });

        Schema::create('inventory_good_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->string('code_name');
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
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inventory_goods');
        Schema::dropIfExists('inventory_good_categories');
        Schema::dropIfExists('inventory_unit_masters');

    }
}
