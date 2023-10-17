<?php

use App\Constants;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAllProcurementMigration extends Migration
{
    private $constants;

    public function __construct()
    {
        $this->constants = new Constants();
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('procurements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('itemable_bill_of_quantity_id')->constrained('itemable_bill_of_quantities');
            $table->enum("type", ["Customer", "Internal"]);
            $table->string('delivery_location');
            $table->string("no_pr");
            $table->string("ref_po_spk_pks")->nullable();
            $table->string("ref_ph")->nullable();
            $table->date("request_date");
            $table->foreignId("requester")->constrained('users');;
            $table->string("customer");
            $table->foreignId("pic")->constrained('users');
            $table->timestamps();
        });

        Schema::create('procurement_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('procurement_id')->constrained('procurements');
            $table->foreignId('inventory_good_id')->constrained('inventory_goods');
            $table->foreignId('item_id')->constrained('items');
            $table->string("need")->nullable();
            $table->integer("quantity");
            $table->char('unit', 10)
                ->comment('unit with char(10)');
            $table->foreign('unit')->references('code')->on('inventory_unit_masters');
            $table->string('vendor')->nullable();
            $table->string('vendor_location')->nullable();
            $table->integer('price');
            $table->integer('shipping_price')->nullable();
            $table->string('payment_method');
            $table->string('purchase_number')->nullable();
            $table->string('no_po_nota')->nullable();
            $table->string('order_by')->nullable();
            $table->string('expedition')->nullable();
            $table->string('receipt_number')->nullable();
            $table->date('estimate_arrived')->nullable();
            $table->integer('aging')->nullable();
            $table->timestamps();
        });

        Schema::create('procurement_item_statuses', function(Blueprint $table){
            $table->id();
            $table->foreignId('procurement_item_id')->constrained('procurement_items');
            $table->enum("status", $this->constants->item_status)->default($this->constants->item_status[0]);
            $table->string("description")->nullable();
            $table->timestamps();
        });

        Schema::create('procurement_item_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('procurement_item_id')->constrained('procurement_items');
            $table->enum("categoty", ["Advance Payment", "Full Payment"]);
            $table->integer("nominal");
            $table->string("file");
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
        Schema::dropIfExists('procurement_item_payments');
        Schema::dropIfExists('procurement_item_statuses');
        Schema::dropIfExists('procurement_items');
        Schema::dropIfExists('procurements');
    }
}
