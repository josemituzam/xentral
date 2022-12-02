<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIspPlanDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('isp_plan_details', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('plan_id')->nullable(true);
            $table->string('installation_cost', 100)->nullable(true);
            $table->string('month_cost', 100)->nullable(true);
            $table->string('penalty_amount', 100)->nullable(true);
            $table->string('meters_free', 100)->nullable(true);
            $table->string('additional_meter_cost', 100)->nullable(true);
            $table->uuid('minimun_permanence_id')->nullable(true);
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
        Schema::dropIfExists('isp_plan_details');
    }
}
