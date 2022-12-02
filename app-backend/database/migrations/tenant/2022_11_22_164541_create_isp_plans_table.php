<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIspPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('isp_plans', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name', 100)->nullable(true);
            $table->string('description', 300)->nullable(true);
            $table->uuid('last_mile_id')->nullable(true);
            $table->string('increase', 100)->nullable(false);
            $table->string('type_increase', 100)->nullable(false);
            $table->string('downfall', 100)->nullable(false);
            $table->string('type_downfall', 100)->nullable(false);
            $table->string('compartition', 100)->nullable(false);
            $table->string('short_code', 5)->nullable(true);
            $table->string('long_code', 10)->nullable(true);
            $table->boolean('is_active')->default(true);
            //
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
        Schema::dropIfExists('isp_plans');
    }
}
