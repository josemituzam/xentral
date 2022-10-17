<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestDomainsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_domains', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('email');
            $table->string('domain_name');
            $table->string('company_name');
            $table->string('password');
            $table->string('tenant_id')->nullable();
            $table->string('type');
            $table->boolean('is_approved')->default(0);
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
        Schema::dropIfExists('request_domains');
    }
}
