<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProspeksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prospeks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('lead_type_id')->constrained();
            $table->foreignId('city_id')->constrained();
            $table->string('company_name');
            $table->string('client_type');
            $table->text('company_address');
            $table->string('lat')->nullable();
            $table->string('lng')->nullable();
            $table->text('prospek_note')->nullable();
            $table->string('prospek_remarks')->nullable();
            $table->string('prospek_next_action')->nullable();
            $table->integer('status')->default(1);  //1 aktif 
            $table->softDeletes(); 
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
        Schema::dropIfExists('prospeks');
    }
}
