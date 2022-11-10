<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIspContactCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('isp_contact_customers', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('customer_id')->nullable(true);
            $table->string('name', 100)->nullable(false);
            $table->string('name_parent', 100)->nullable(false);
            $table->string('email')->unique()->nullable(true);
            //Type Phone
            $table->enum('type_number', ['FIJ', 'MOV'])->nullable(true);
            /*
              * FIJ: Fijo
              * MOV: Móvil
              */
            //$table->string('phone_fixed', 100)->nullable(true);
            $table->longText('phone')->nullable(true);
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
        Schema::dropIfExists('isp_contact_customers');
    }
}