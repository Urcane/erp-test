<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAllSurveyMigrationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->string('name')->index();
            $table->morphs('fileable');
            $table->string('additional')->nullable()->index();
            $table->string('path')->index();
            $table->foreignId('user_id')->constrained();
            $table->softDeletes()->index();
            $table->timestamps();
        });

        Schema::create('service_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('model_name')->nullable()->index();
            $table->softDeletes()->index();
            $table->timestamps();
        });

        Schema::create('internet_service_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->softDeletes()->index();
            $table->timestamps();
        });

        Schema::create('type_of_surveys', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->softDeletes()->index();
            $table->timestamps();
        });

        Schema::create('transmission_medias', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->softDeletes()->index();
            $table->timestamps();
        });

        Schema::create('camera_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->softDeletes()->index();
            $table->timestamps();
        });

        Schema::create('survey_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_prospect_id')->constrained()->nullable();
            $table->foreignId('service_type_id')->constrained();
            $table->foreignId('type_of_survey_id')->comment('soft survey/hard survey')->constrained();
            $table->unsignedBigInteger('soft_surveyed_by')->nullable();
            $table->foreign('soft_surveyed_by')->references('id')->on('users');
            $table->string('no_survey', 50)->unique();
            $table->dateTime('survey_datetime');
            $table->decimal('lat', 16,12)
                ->nullable()
                ->comment('lattitude site');
            $table->decimal('lang', 16,12)
                ->nullable()
                ->comment('langitude site');
            $table->string('closest_bts')->nullable();
            $table->boolean('covered_status')->default(0)->index();
            $table->string('notes')->nullable();
            $table->timestamps();
        });

        Schema::create('work_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('work_list_id')->nullable()->constrained();
            $table->foreignId('survey_request_id')->nullable()->constrained()->comment('fillable when type of wo is SR/Survey');
            $table->string('no_wo', 50)->unique();
            $table->string('task_description');
            $table->dateTime('start_date')->index();
            $table->dateTime('planning_due_date')->index();
            // $table->enum('status', ['PENDING', 'DONE', 'INPROGRESS', 'FREEZE']);
            $table->char('status', 2)
                ->comment('status with char(2), example: DN = Done, PR = In Progress, FR = Freeze, PD = Pending');
            $table->foreign('status')->references('code')->on('work_statuses');
            $table->char('type_of_wo', 2)
                ->comment('type of wo category with char(2)');
            $table->foreign('type_of_wo')->references('code')->on('work_order_categories');

            $table->boolean('approved_status')->nullable()->index();
            $table->unsignedBigInteger('approved_by')->nullable();
            $table->foreign('approved_by')->references('id')->on('users');
            $table->dateTime('approved_date')->nullable()->index();

            $table->softDeletes()->index();
            $table->timestamps();
        });

        Schema::table('work_orders', function (Blueprint $table) {
            $table->unsignedBigInteger('reference_work_order_id')->nullable()->after('approved_date');
            $table->foreign('reference_work_order_id')->references('id')->on('work_orders');
        });

        Schema::create('site_surveys', function (Blueprint $table) {
            $table->id();
            $table->foreignId('survey_request_id')->constrained();
            $table->foreignId('work_order_id')->nullable()->constrained();
            $table->foreignId('service_type_id')->nullable()->constrained();
            $table->foreignId('trans_media_id')->constrained('transmission_medias');
            $table->foreignId('internet_service_type_id')->nullable()->constrained();
            $table->string('existing_connection')->nullable();
            $table->string('transportation_access');
            $table->string('building_type');
            $table->bigInteger('building_height');
            $table->integer('building_floor_count')->nullable();
            $table->boolean('building_rooftop_state')->default(0)->index();
            $table->boolean('building_electricity_state')->default(0)->index();
            $table->integer('building_electricity_time')->nullable();
            $table->enum('building_electricity_type', ['PLN', 'GENSET', 'SOLARCELL'])->nullable()->index();
            $table->timestamps();
        });

        Schema::create('soft_surveys', function (Blueprint $table) {
            $table->id();
            $table->foreignId('survey_request_id')->constrained();
            $table->foreignId('work_order_id')->nullable()->constrained();
            $table->string('description');
            $table->string('attachment_url')->index();
            $table->timestamps();
        });

        Schema::create('site_survey_internets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('site_survey_id')->constrained();
            $table->bigInteger('quantity_service_use');
            $table->string('user_needs');
            $table->bigInteger('bandwith_needs');
            $table->string('special_request')->nullable();
            $table->timestamps();
        });

        Schema::create('site_survey_cctvs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('site_survey_id')->constrained();
            $table->foreignId('camera_type_id')->constrained();
            $table->bigInteger('quantity_service_use');
            $table->string('record_duration');
            $table->string('camera_storage');
            $table->string('camera_resolution');
            $table->string('special_request')->nullable();
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
        Schema::dropIfExists('site_survey_cctvs');
        Schema::dropIfExists('site_survey_internets');
        Schema::dropIfExists('soft_surveys');
        Schema::dropIfExists('site_surveys');

        Schema::dropIfExists('work_orders');

        Schema::dropIfExists('survey_requests');
        Schema::dropIfExists('camera_types');
        Schema::dropIfExists('transmission_medias');
        Schema::dropIfExists('type_of_surveys');
        Schema::dropIfExists('internet_service_types');
        Schema::dropIfExists('service_types');
        Schema::dropIfExists('files');
    }
}
