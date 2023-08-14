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
        

        Schema::create('inventory_good_categories', function (Blueprint $table) {
            $table->id()->index();
            $table->string('name');
            $table->string('description');
            $table->string('code_name');
            $table->timestamps();
        });

        Schema::create('inventory_goods', function (Blueprint $table) {
            $table->id();
            $table->foreignId('good_category_id')->constrained('inventory_good_categories')->cascadeOnDelete();
            $table->string('good_name');
            $table->string('code_name');
            $table->string('merk');
            $table->string('good_type');
            $table->string('description');
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
    }
}
