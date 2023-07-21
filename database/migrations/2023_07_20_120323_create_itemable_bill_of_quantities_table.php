<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemableBillOfQuantitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('itemable_bill_of_quantities', function (Blueprint $table) {
            $table->id();
            $table->integer('project_list_id');
            $table->integer('sales_id');
            $table->integer('technician_id');
            $table->integer('procurement_id');
            $table->bigInteger('gpm')->digits(20)->nullable();
            $table->bigInteger('modal')->digits(20);
            $table->bigInteger('npm')->digits(20);
            $table->integer('percentage')->digits(4);
            $table->integer('manpower')->digits(4);
            $table->string('is_draft')->nullable();
            $table->boolean('approval_manager')->nullable();
            $table->date('approval_manager_date')->nullable();
            $table->boolean('approval_director')->nullable();
            $table->date('approval_director_date')->nullable();
            $table->boolean('approval_finman')->nullable();
            $table->date('approval_finman_date')->nullable();
            $table->integer('reference_bill_of_quantity_id')->nullable()->digits(4);
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
        Schema::dropIfExists('itemable_bill_of_quantities');
    }
}
