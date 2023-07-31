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

        Schema::create('site_survey_service_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('category');
            $table->softDeletes()->index();
            $table->timestamps();
        });

        Schema::create('internet_bandwidths', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->softDeletes()->index();
            $table->timestamps();
        });

        Schema::create('site_survey_interfaces', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('category')->index();
            $table->softDeletes()->index();
            $table->timestamps();
        });

        Schema::create('cctv_record_durations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->softDeletes()->index();
            $table->timestamps();
        });

        Schema::create('cctv_storage_capacities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->softDeletes()->index();
            $table->timestamps();
        });

        Schema::create('gsm_booster_natural_frequencies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->softDeletes()->index();
            $table->timestamps();
        });

        Schema::create('gsm_booster_repeater_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->softDeletes()->index();
            $table->timestamps();
        });

        Schema::create('gsm_booster_connectivity_datas', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->softDeletes()->index();
            $table->timestamps();
        });

        Schema::create('outdoor_cable_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->softDeletes()->index();
            $table->timestamps();
        });

        Schema::create('power_sources', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('category')->nullable()->index();
            $table->softDeletes()->index();
            $table->timestamps();
        });

        Schema::create('type_of_surveys', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->softDeletes()->index();
            $table->timestamps();
        });

        Schema::create('transportation_acceses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->softDeletes()->index();
            $table->timestamps();
        });

        Schema::create('building_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->softDeletes()->index();
            $table->timestamps();
        });

        // Schema::create('transmission_medias', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('name');
        //     $table->softDeletes()->index();
        //     $table->timestamps();
        // });

        // Schema::create('camera_types', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('name');
        //     $table->softDeletes()->index();
        //     $table->timestamps();
        // });

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

        Schema::create('soft_surveys', function (Blueprint $table) {
            $table->id();
            $table->foreignId('survey_request_id')->constrained();
            // $table->foreignId('work_order_id')->nullable()->constrained();
            // $table->string('attachment_url')->index();
            $table->string('description');
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

        Schema::create('site_survey_outdoor_areas', function (Blueprint $table) {
            $table->id();
            $table->boolean('tower_available_status')->default(0)->index();
            $table->string('tower_available_status_note')->nullable();
            $table->bigInteger('closest_site_range')->nullable();
            $table->string('closest_site_range_note')->nullable();
            $table->bigInteger('closest_tower_status')->nullable();
            $table->string('closest_tower_status_note')->nullable();
            $table->boolean('thunder_protector_status')->default(0)->index();
            $table->string('thunder_protector_status_note')->nullable();
            $table->boolean('grounding_status')->default(0)->index();
            $table->string('grounding_status_note')->nullable();
            $table->boolean('cable_tray_status')->default(0)->index();
            $table->string('cable_tray_status_note')->nullable();
            $table->boolean('pondation_status')->default(0)->index();
            $table->string('pondation_status_note')->nullable();
            $table->timestamps();
        });

        Schema::create('site_survey_indoor_areas', function (Blueprint $table) {
            $table->id();
            $table->boolean('room_status')->default(0)->index();
            $table->string('room_status_note')->nullable();
            $table->boolean('air_conditioning_status')->default(0)->index();
            $table->string('air_conditioning_status_note')->nullable();
            $table->foreignId('power_source_id')->nullable()->constrained();
            $table->string('power_source_note')->nullable();
            $table->boolean('mcb_status')->nullable()->index();
            $table->string('mcb_status_note')->nullable();
            $table->enum('mcb_type', ['AC', 'DC'])->nullable()->index();
            $table->string('mcb_type_note')->nullable();
            $table->string('voltage_phase_to_neutral')->default('0');
            $table->string('voltage_phase_to_ground')->default('0');
            $table->string('voltage_neutral_to_ground')->default('0');
            $table->string('voltage_frequency')->nullable();
            $table->string('voltage_note')->nullable();
            $table->boolean('ups_regulator_status')->default(0)->index();
            $table->string('ups_regulator_status_note')->nullable();
            $table->boolean('table_status')->default(0)->index();
            $table->string('table_status_note')->nullable();
            $table->timestamps();
        });

        Schema::create('site_survey_other_areas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('outdoor_cable_type_id')->nullable()->constrained();
            $table->enum('cable_power_type', ['INDOOR', 'OUTDOOR'])->nullable();
            $table->enum('grounding_cable_type', ['TUNGGAL', 'SERABUT'])->nullable();
            $table->boolean('connection_configuration_status')->nullable();
            $table->foreignId('transportation_access_id')->constrained();
            $table->foreignId('building_type_id')->constrained();
            $table->string('notes')->nullable();
            $table->timestamps();
        });

        Schema::create('site_survey_internets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('survey_request_id')->constrained();
            $table->foreignId('customer_id')->constrained();
            $table->foreignId('customer_contact_id')->constrained();
            $table->foreignId('work_order_id')->nullable()->constrained();
            $table->foreignId('site_survey_service_type_id')->constrained();
            $table->string('local_acceses', 100);
            $table->foreignId('internet_bandwidth_id')->constrained();
            $table->foreignId('site_survey_interface_id')->constrained();
            $table->date('survey_date')->index();
            $table->foreignId('site_survey_outdoor_area_id')->constrained();
            $table->foreignId('site_survey_indoor_area_id')->constrained();
            $table->foreignId('site_survey_other_area_id')->constrained();
            $table->foreignId('survey_executor_id')->constrained('users', 'id');
            $table->softDeletes()->index();
            $table->timestamps();
        });

        Schema::create('site_survey_cctvs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('survey_request_id')->constrained();
            $table->foreignId('customer_id')->constrained();
            $table->foreignId('customer_contact_id')->constrained();
            $table->foreignId('work_order_id')->nullable()->constrained();
            $table->foreignId('site_survey_service_type_id')->constrained();
            $table->bigInteger('quantity');
            $table->string('local_acceses', 100);
            $table->foreignId('cctv_record_duration_id')->constrained();
            $table->foreignId('cctv_storage_capacity_id')->constrained();
            $table->foreignId('site_survey_interface_id')->constrained();
            $table->date('survey_date')->index();
            $table->foreignId('site_survey_outdoor_area_id')->constrained();
            $table->foreignId('site_survey_indoor_area_id')->constrained();
            $table->foreignId('site_survey_other_area_id')->constrained();
            $table->foreignId('survey_executor_id')->constrained('users', 'id');
            $table->softDeletes()->index();
            $table->timestamps();
        });

        Schema::create('site_survey_gsm_boosters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('survey_request_id')->constrained();
            $table->foreignId('customer_id')->constrained();
            $table->foreignId('customer_contact_id')->constrained();
            $table->foreignId('work_order_id')->nullable()->constrained();
            $table->foreignId('gsm_booster_natural_frequency_id')->constrained();
            $table->bigInteger('natural_signal_rsrp')->nullable();
            $table->bigInteger('natural_signal_rsrq')->nullable();
            $table->foreignId('gsm_booster_repeater_type_id')->constrained();
            $table->enum('anthena_donor_type', ['PERIODIK', 'GRID', 'OMNI'])->index();
            $table->enum('anthena_service', ['OMNI', 'SECTORAL', 'PLANNER'])->index();
            $table->foreignId('gsm_booster_conectivity_data_id')->constrained();
            $table->date('survey_date')->index();
            $table->foreignId('site_survey_outdoor_area_id')->constrained();
            $table->foreignId('site_survey_indoor_area_id')->constrained();
            $table->foreignId('site_survey_other_area_id')->constrained();
            $table->foreignId('survey_executor_id')->constrained('users', 'id');
            $table->softDeletes()->index();
            $table->timestamps();
        });

        Schema::create('site_survey_coordinates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('site_survey_outdoor_area_id');
            $table->decimal('lat', 16,12)
                ->nullable()
                ->comment('lattitude site');
            $table->decimal('lang', 16,12)
                ->nullable()
                ->comment('langtitude site');
            $table->timestamps();
        });

        // Schema::create('site_surveys', function (Blueprint $table) {
        //     $table->id();
        //     $table->foreignId('survey_request_id')->constrained();
        //     $table->foreignId('work_order_id')->nullable()->constrained();
        //     $table->foreignId('service_type_id')->nullable()->constrained();
        //     $table->foreignId('trans_media_id')->constrained('transmission_medias');
        //     $table->foreignId('site_survey_service_type_id')->nullable()->constrained();
        //     $table->string('existing_connection')->nullable();
        //     $table->string('transportation_access');
        //     $table->string('building_type');
        //     $table->bigInteger('building_height');
        //     $table->integer('building_floor_count')->nullable();
        //     $table->boolean('building_rooftop_state')->default(0)->index();
        //     $table->boolean('building_electricity_state')->default(0)->index();
        //     $table->integer('building_electricity_time')->nullable();
        //     $table->enum('building_electricity_type', ['PLN', 'GENSET', 'SOLARCELL'])->nullable()->index();
        //     $table->timestamps();
        // });

        // Schema::create('cctv_outdoor_areas', function (Blueprint $table) {
        //     $table->id();
        //     $table->boolean('tower_available_status')->default(0)->index();
        //     $table->string('tower_available_status_note')->nullable();
        //     $table->boolean('thunder_protector_status')->default(0)->index();
        //     $table->string('thunder_protector_status_note')->nullable();
        //     $table->boolean('grounding_status')->default(0)->index();
        //     $table->string('grounding_status_note')->nullable();
        //     $table->boolean('cable_tray_status')->default(0)->index();
        //     $table->string('cable_tray_status_note')->nullable();
        //     $table->timestamps();
        // });

        // Schema::create('cctv_indoor_areas', function (Blueprint $table) {
        //     $table->id();
        //     $table->boolean('room_status')->default(0)->index();
        //     $table->string('room_status_note')->nullable();
        //     $table->boolean('air_conditioning_status')->default(0)->index();
        //     $table->string('air_conditioning_status_note')->nullable();
        //     $table->foreignId('power_source_id')->constrained();
        //     $table->string('power_source_note')->nullable();
        //     $table->enum('mcb_type', ['AC', 'DC'])->nullable()->index();
        //     $table->string('mcb_type_note')->nullable();
        //     $table->string('voltage_phase_to_neutral')->default('0');
        //     $table->string('voltage_phase_to_ground')->default('0');
        //     $table->string('voltage_neutral_to_ground')->default('0');
        //     $table->string('voltage_frequency')->nullable();
        //     $table->string('voltage_note');
        //     $table->boolean('ups_regulator_status')->default(0)->index();
        //     $table->string('ups_regulator_status_note')->nullable();
        //     $table->boolean('table_status')->default(0)->index();
        //     $table->string('table_status_note')->nullable();
        //     $table->timestamps();
        // });

        // Schema::create('cctv_other_areas', function (Blueprint $table) {
        //     $table->id();
        //     $table->enum('cable_power_type', ['INDOOR', 'OUTDOOR']);
        //     $table->enum('grounding_cable_type', ['TUNGGAL', 'SERABUT']);
        //     $table->boolean('connection_configuration_status');
        //     $table->foreignId('transportation_access_id')->constrained();
        //     $table->foreignId('building_type_id')->constrained();
        //     $table->string('notes');
        //     $table->timestamps();
        // });

        // Schema::create('gsm_booster_outdoor_areas', function (Blueprint $table) {
        //     $table->id();
        //     $table->boolean('tower_available_status')->default(0)->index();
        //     $table->string('tower_available_status_note')->nullable();
        //     $table->bigInteger('closest_tower_status')->nullable();
        //     $table->string('closest_tower_status_note')->nullable();
        //     $table->boolean('thunder_protector_status')->default(0)->index();
        //     $table->string('thunder_protector_status_note')->nullable();
        //     $table->boolean('grounding_status')->default(0)->index();
        //     $table->string('grounding_status_note')->nullable();
        //     $table->boolean('cable_tray_status')->default(0)->index();
        //     $table->string('cable_tray_status_note')->nullable();
        //     $table->timestamps();
        // });

        // Schema::create('gsm_booster_indoor_areas', function (Blueprint $table) {
        //     $table->id();
        //     $table->boolean('room_status')->default(0)->index();
        //     $table->string('room_status_note')->nullable();
        //     $table->boolean('air_conditioning_status')->default(0)->index();
        //     $table->string('air_conditioning_status_note')->nullable();
        //     $table->foreignId('power_source_id')->constrained();
        //     $table->string('power_source_note')->nullable();
        //     $table->boolean('mcb_status')->nullable()->index();
        //     $table->string('mcb_status_note')->nullable();
        //     $table->string('voltage_phase_to_neutral')->default('0');
        //     $table->string('voltage_phase_to_ground')->default('0');
        //     $table->string('voltage_neutral_to_ground')->default('0');
        //     $table->string('voltage_frequency')->nullable();
        //     $table->string('voltage_note');
        //     $table->boolean('ups_regulator_status')->default(0)->index();
        //     $table->string('ups_regulator_status_note')->nullable();
        //     $table->boolean('table_status')->default(0)->index();
        //     $table->string('table_status_note')->nullable();
        //     $table->timestamps();
        // });

        // Schema::create('gsm_booster_other_areas', function (Blueprint $table) {
        //     $table->id();
        //     $table->foreignId('transportation_access_id')->constrained();
        //     $table->foreignId('building_type_id')->constrained();
        //     $table->string('notes');
        //     $table->timestamps();
        // });
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
