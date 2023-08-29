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
            $table->morphs('itemable');
            $table->foreignId('inventory_good_id')->constrained();
            $table->string('item_detail')->nullable();
            $table->bigInteger('quantity');
            $table->char('unit', 2)
                ->comment('unit with char(2)');
            $table->foreign('unit')->references('code')->on('inventory_unit_masters');
            $table->string('delivery_route')->nullable()->comment('price request only');
            $table->string('delivery_type')->nullable()->comment('price request only');
            $table->bigInteger('purchase_price')->default(0);
            $table->bigInteger('purchase_delivery_charge')->default(0);
            $table->string('purchase_from')->nullable()->comment('price request only');
            $table->string('purchase_reference')->nullable()->comment('price request only');
            $table->string('payment_type')->nullable()->comment('part request only');
            $table->string('purchase_validity')->nullable()->comment('part request only');
            $table->string('done_date')->nullable()->comment('part request only');
            $table->bigInteger('total_price')->default(0);
            $table->bigInteger('markup_price')->nullable()->index()->comment('boq commerc only');
            $table->char('status', 2)->default('PR')
                ->comment('status with char(2), example: DN = Done, PR = In Progress, FR = Freeze, PD = Pending');
            $table->foreign('status')->references('code')->on('work_statuses');
            $table->foreignId('procurement_id')->nullable()->constrained('users');
            $table->boolean('approval_manager')->nullable();
            $table->dateTime('approval_manager_date')->nullable();
            $table->boolean('approval_director')->nullable();
            $table->dateTime('approval_director_date')->nullable();
            $table->boolean('approval_finman')->nullable();
            $table->dateTime('approval_finman_date')->nullable();
            $table->timestamps();
        });

        Schema::create('itemable_bill_of_quantities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('prospect_id')->constrained('customer_prospects');
            $table->foreignId('survey_request_id')->nullable()->constrained();
            $table->foreignId('sales_id')->constrained('users');
            $table->foreignId('technician_id')->constrained('users');
            $table->foreignId('procurement_id')->constrained('users');
            $table->bigInteger('gpm')->default(0);
            $table->bigInteger('modal')->default(0);
            $table->bigInteger('npm')->default(0);
            $table->integer('percentage')->digits(4)->default(0);
            $table->integer('manpower')->digits(4)->default(0);
            $table->boolean('is_draft')->default(1);
            $table->boolean('is_done')->nullable();
            $table->boolean('is_final')->default(0);
            $table->string('remark')->nullable();
            $table->boolean('approval_manager')->nullable();
            $table->date('approval_manager_date')->nullable();
            $table->boolean('approval_director')->nullable();
            $table->date('approval_director_date')->nullable();
            $table->boolean('approval_finman')->nullable();
            $table->date('approval_finman_date')->nullable();
            $table->foreignId('reference_boq_id')->constrained('itemable_bill_of_quantities');
            $table->timestamps();
        });

        Schema::create('itemable_price_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('work_list_id')->nullable()->constrained('work_lists');
            $table->foreignId('itemable_bill_of_quantity_id')->constrained('itemable_bill_of_quantities');
            $table->foreignId('customer_contact_id')->constrained('customer_contacts');
            $table->foreignId('customer_company_id')->constrained('customers');
            $table->string('no_ph');
            $table->string('release_date');
            $table->foreignId('reference_price_request_id')->digits(4)->constrained('itemable_price_requests');
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
