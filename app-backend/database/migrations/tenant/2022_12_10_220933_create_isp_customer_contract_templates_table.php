<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIspCustomerContractTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('isp_customer_contract_templates', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('contract_id')->nullable(true);
            $table->longText('html')->nullable(true);
            $table->uuid('created_by')->nullable(true);
            $table->boolean('is_signed')->default(false);
            $table->boolean('is_generated')->default(false);
            $table->uuid('updated_by')->nullable(true);
            $table->uuid('deleted_by')->nullable(true);
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
        Schema::dropIfExists('isp_customer_contract_templates');
    }
}
