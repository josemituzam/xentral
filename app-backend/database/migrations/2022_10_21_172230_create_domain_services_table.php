<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDomainServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('domain_services', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('request_domain_id')->nullable(true);
            $table->uuid('service_id')->nullable(true);
            $table->float('price_monthly', 15, 4)->default(0);
            $table->float('price_yearly', 15, 4)->default(0);
            $table->integer('max_users')->default(0);
            //
            $table->string('type', 10)->default('USER'); // USER, COMPANY, CUSTOM
            $table->string('short_code', 5)->nullable(true);
            $table->string('long_code', 10)->nullable(true);
            $table->integer('order')->nullable(true);
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
        Schema::dropIfExists('domain_services');
    }
}
