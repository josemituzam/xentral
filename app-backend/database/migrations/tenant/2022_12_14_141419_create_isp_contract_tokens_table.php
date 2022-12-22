<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIspContractTokensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('isp_contract_tokens', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('contract_id')->nullable(true);
            $table->string('token_id', 200)->nullable(true);
            $table->string('token_expired', 200)->nullable(true);
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
        Schema::dropIfExists('isp_contract_tokens');
    }
}
