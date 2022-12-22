<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIspTemplateContractSignaturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('isp_template_contract_signatures', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('customer_contract_template_id')->nullable(true);
            $table->string('name', 100)->nullable(true);
            $table->string('description', 300)->nullable(true);
            $table->boolean('is_active')->default(true);
            $table->boolean('is_required')->default(true);
            $table->binary('signature')->nullable(true);
            $table->string('short_code', 5)->nullable(true);
            $table->string('orderby', 5)->nullable(true);
            $table->string('long_code', 50)->nullable(true);
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
        Schema::dropIfExists('isp_template_contract_signatures');
    }
}
