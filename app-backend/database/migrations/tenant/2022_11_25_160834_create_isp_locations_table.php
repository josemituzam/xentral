<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIspLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('isp_locations', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('location', 300)->nullable(true);
            $table->string('city', 100)->nullable(true);
            $table->string('state', 100)->nullable(true);
            $table->string('short_code', 5)->nullable(true);
            $table->string('long_code', 10)->nullable(true);
            $table->boolean('is_active')->default(true);
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
        Schema::dropIfExists('isp_locations');
    }
}
