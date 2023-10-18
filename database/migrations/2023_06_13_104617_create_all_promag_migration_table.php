<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAllPromagMigrationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_has_models', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained();
            $table->morphs('userable');
            $table->timestamps();
        });

        // Start: Project Migration

        Schema::create('work_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->char('code', 2)->unique();
            $table->timestamps();
        });

        Schema::create('work_progress_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->char('code', 3)->unique();
            $table->timestamps();
        });

        Schema::create('work_order_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->char('code', 2)->unique();
            $table->softDeletes()->index();
            $table->timestamps();
        });

        Schema::create('work_lists', function (Blueprint $table) {
            $table->id();

            // foreign key dipindahkan kedalam all_boq_migration
            // $table->foreignId('itemable_bill_of_quantity_id');

            // $table->foreignId('itemable_quotation_part_id')
            //     ->nullable();

            $table->string('no_project', 36)
                ->nullable()
                ->unique()
                ->comment('No Project dengan max varchar = 36');

            $table->string('work_name', 100)
                ->comment('Nama Project dengan max varchar = 100');

            $table->string('work_desc');

            $table->string('work_location')
                ->comment('Alamat lengkap site');

            $table->decimal('lat', 16,12)
                ->nullable()
                ->comment('lattitude site');

            $table->decimal('lang', 16,12)
                ->nullable()
                ->comment('langitude site');

            $table->string('no_po_customer', 50)
                ->nullable()
                ->index()
                ->comment('no po customer dengan max varchart = 50');

            $table->char('status', 2)
                ->comment('status with char(2), example: DN = Done, PR = In Progress, FR = Freeze, PD = Pending');
            $table->foreign('status')->references('code')->on('work_statuses');

            $table->char('last_progress_category', 3)
                ->comment('progress category with char(3), example: CMS = Commisioning, PRC = Pengadaan/Procurement, PRD = Pra-Development, TSB = Testing Bugs, DEV = Development');
            $table->foreign('last_progress_category')->references('code')->on('work_progress_categories');

            $table->decimal('progress', 5, 2)
                ->default(0)
                ->index()
                ->comment('percentage progress');

            $table->boolean('is_desa')
                ->default(0)
                ->index()
                ->comment('status if the project is on desa/village');

            $table->dateTime('start_date')
                ->nullable();

            $table->dateTime('due_date')
                ->nullable();

            $table->dateTime('actual_done_date')
                ->nullable();

            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('task_lists', function (Blueprint $table) {
            $table->id();
            $table->string('task_name');
            $table->string('task_description');

            $table->char('progress_category', 3)
                ->comment('progress category with char(3), example: CMS = Commisioning, PRC = Pengadaan/Procurement, PRD = Pra-Development, TSB = Testing Bugs, DEV = Development');
            $table->foreign('progress_category')->references('code')->on('work_progress_categories');

            $table->char('status', 2)
                ->comment('status with char(2), example: DN = Done, PR = In Progress, FR = Freeze, PD = Pending');
            $table->foreign('status')->references('code')->on('work_statuses');

            $table->decimal('progress', 5, 2)
                ->default(0)
                ->index()
                ->comment('percentage progress');

            $table->dateTime('start_date')
                ->nullable();

            $table->dateTime('due_date')
                ->nullable();

            $table->dateTime('actual_done_date')
                ->nullable();

            $table->timestamps();
        });

        Schema::create('task_attachments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('task_list_id')->constrained();
            $table->foreignId('work_list_id')->constrained();
            $table->string('url');
            $table->timestamps();
        });

        Schema::create('task_checklists', function (Blueprint $table) {
            $table->id();
            $table->foreignId('task_list_id')->constrained();
            $table->string('task_name');
            $table->boolean('status');
            $table->timestamps();
        });

        Schema::create('task_comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('task_list_id')->constrained();
            $table->string('comments', 2000);
            $table->timestamps();
        });

        // End: Project Migration
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('task_comments');
        Schema::dropIfExists('task_checklists');
        Schema::dropIfExists('task_attachments');
        Schema::dropIfExists('task_lists');

        Schema::dropIfExists('work_lists');
        Schema::dropIfExists('work_order_categories');
        Schema::dropIfExists('work_progress_categories');
        Schema::dropIfExists('work_statuses');
        Schema::dropIfExists('user_has_models');
    }
}
