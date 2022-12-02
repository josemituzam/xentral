<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIspContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('isp_contracts', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('username', 100)->nullable(true);

            $table->date('emission_at')->nullable(true);
            $table->date('break_at', 100)->nullable(true);
            $table->string('address_contract', 200)->nullable(true);
            $table->string('address_contract', 200)->nullable(true);

            $table->uuid('sector_id')->nullable(true);
            $table->uuid('customer_id')->nullable(true);
            $table->uuid('contract_plan_id')->nullable(true);
            $table->uuid('contract_version_id')->nullable(true);
            $table->uuid('payment_id')->nullable(true);
            $table->uuid('adviser_id')->nullable(true);
            $table->uuid('status_id')->nullable(true);
            $table->uuid('another_provider_id')->nullable(true);
            //

            $table->boolean('is_reconnection_cost')->default(false);
            $table->boolean('is_from_another_provider')->default(false);
            $table->boolean('is_pay_to_invoice')->default(false);
            $table->boolean('is_apply_arcotel')->default(false);
            $table->boolean('is_not_cut_for_debt')->default(false);
            $table->boolean('is_not_generate_invoice_service')->default(false);



            $table->uuid('created_by')->nullable(true);
            $table->uuid('updated_by')->nullable(true);
            $table->uuid('deleted_by')->nullable(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('isp_contracts');
    }
}
