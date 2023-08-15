<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAllBoqMigrationTable extends Migration
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
            $table->foreignId('item_inventory_id')->nullable()->constrained('inventory_goods');
            $table->string('item_detail')->nullable();
            $table->string('quantity')->nullable();
            $table->string('purchase_price')->nullable();
            $table->string('purchase_delivery_charge')->nullable();
            $table->string('purchase_refrence')->nullable();
            $table->string('total_price')->nullable();
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

        Schema::create('itemable_price_requests', function (Blueprint $table) {
            $table->id();
            $table->integer('survey_id')->nullable();
            $table->foreignId('work_list_id')->nullable()->constrained('work_lists');
            $table->foreignId('customer_contact_id')->constrained('customer_contacts');
            $table->foreignId('customer_company_id')->constrained('customers');
            $table->string('no_ph')->nullable();
            $table->string('release_date')->nullable();
            $table->foreignId('reference_price_request_id')->digits(4)->constrained('itemable_price_requests');
            $table->timestamps();
        });
        
        Schema::create('itemable_bill_of_quantities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('prospect_id')->constrained('customer_prospects');
            $table->integer('survey_request_id')->nullable();
            $table->foreignId('sales_id')->nullable()->constrained('users');
            $table->foreignId('technician_id')->nullable()->constrained('users');
            $table->foreignId('procurement_id')->nullable()->constrained('users');
            $table->bigInteger('gpm')->digits(20)->nullable();
            $table->bigInteger('modal')->digits(20)->nullable();
            $table->bigInteger('npm')->digits(20)->nullable();
            $table->integer('percentage')->digits(4)->nullable();
            $table->integer('manpower')->digits(4)->nullable();
            $table->boolean('is_draft')->default(1);
            $table->boolean('is_done')->nullable();
            $table->boolean('approval_manager')->nullable();
            $table->date('approval_manager_date')->nullable();
            $table->boolean('approval_director')->nullable();
            $table->date('approval_director_date')->nullable();
            $table->boolean('approval_finman')->nullable();
            $table->date('approval_finman_date')->nullable();
            $table->foreignId('reference_boq_id')->digits(4)->constrained('itemable_bill_of_quantities');
            $table->timestamps();
        });

        Schema::create('itemable_quotation_parts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('prospect_id')->constrained('customer_prospects');
            $table->foreignId('survey_request_id')->nullable();
            $table->string('no_quotation');
            $table->string('description');
            $table->bigInteger('total_price')->digits(20);
            $table->foreignId('referenced_quotation_id')->constrained('itemable_quotation_parts');
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
        Schema::dropIfExists('itemable_price_requests');
        Schema::dropIfExists('itemable_bill_of_quantities');
        Schema::dropIfExists('itemable_quotation_parts');
    }
}
