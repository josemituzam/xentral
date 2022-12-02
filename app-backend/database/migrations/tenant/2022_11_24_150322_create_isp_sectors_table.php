<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIspSectorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('isp_sectors', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('sector', 300)->nullable(true);
            $table->uuid('location_id')->nullable(true);
            $table->string('latitude', 200)->nullable(true);
            $table->string('longitude', 200)->nullable(true);
            $table->string('short_code', 5)->nullable(true);
            $table->string('long_code', 10)->nullable(true);
            $table->boolean('is_active')->default(true);
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
        Schema::dropIfExists('isp_sectors');
    }
}
