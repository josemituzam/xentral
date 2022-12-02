<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIspContractPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('isp_contract_plans', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('plan_id')->nullable(true);
            $table->string('installation_cost', 100)->nullable(true);
            $table->string('month_cost', 100)->nullable(true);
            $table->uuid('minimun_permanence_id')->nullable(true);
            $table->string('compartition', 100)->nullable(false);
            $table->boolean('is_permanence_cost')->default(false);
            $table->string('permanence_cost', 100)->nullable(true);

            $table->uuid('created_by')->nullable(true);
            $table->uuid('updated_by')->nullable(true);
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
        Schema::dropIfExists('isp_contract_plans');
    }
}
