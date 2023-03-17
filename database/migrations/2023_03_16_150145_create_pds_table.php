<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pds', function (Blueprint $table) {
            $table->id();
            $table->integer('work_list_id')->nullable()->nullable(); // kalau jadi project
            $table->integer('prospek_id')->nullable()->nullable(); // kalau masih prospek
            $table->foreignId('user_id')->constrained();
            $table->integer('pd_no');
            $table->string('pd_type'); //projek/lain
            $table->text('pd_desc');
            $table->integer('pd_approval_manager')->nullable(); //id user
            $table->integer('pd_approval_finance')->nullable(); //id user
            $table->string('pd_maker_file')->nullable();
            $table->bigInteger('pd_sub_total')->default(0);
            $table->bigInteger('pd_total')->default(0);
            $table->integer('status')->default(1);
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
        Schema::dropIfExists('pds');
    }
}
