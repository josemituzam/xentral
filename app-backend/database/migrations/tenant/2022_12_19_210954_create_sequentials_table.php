<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSequentialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sequentials', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->integer('contracts')->default(0);
            $table->integer('tickets')->default(0);
            $table->integer('accounts_receivable')->default(0);
            $table->integer('advances')->default(0);
            $table->integer('returns')->default(0);
            $table->integer('sales_notes')->default(0);
            $table->integer('proformas')->default(0);
            $table->integer('bills')->default(0);
            $table->string('type')->nullable(true);
            $table->string('short_code', 5)->nullable(true);
            $table->string('long_code', 10)->nullable(true);
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
        Schema::dropIfExists('sequentials');
    }
}
