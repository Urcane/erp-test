<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProspekKontaksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prospek_kontaks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('prospek_id')->constrained();
            $table->string('name');
            $table->email('email')->nullable();
            $table->integer('job_position');
            $table->string('kontak');
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
        Schema::dropIfExists('prospek_kontaks');
    }
}
