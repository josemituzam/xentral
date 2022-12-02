<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIspCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('isp_customers', function (Blueprint $table) {
            $table->uuid('id')->primary();

            //Names
            $table->string('name_company', 100)->nullable(true);
            $table->string('firstname', 100)->nullable(true);
            $table->string('lastname', 100)->nullable(true);
            $table->string('fullname', 100)->nullable(true);

            //Identifications
            $table->enum('type_identification', ['IDE', 'RUC', 'PTE'])->nullable(false);
            /*
             * IDE: Identificación
             * RUC: Registro único constribuyente 
             * PTE: Pasaporte
             */
            $table->string('identification', 100)->nullable(false);

            $table->string('photo', 100)->nullable(false);

            //Type People
            $table->enum('type_people', ['PN', 'PJ'])->nullable(true);
            /*
             * PN: Persona Natural
             * PJ: Persona Jurídica 
             */
            $table->date('started_at')->nullable(true);
            $table->string('address', 100)->nullable(true);
            $table->string('email', 100)->nullable(true);

            //Type Phone
            $table->enum('type_number', ['FIJ', 'MOV'])->nullable(true);
            /*
             * FIJ: Fijo
             * MOV: Móvil
             */
            //$table->string('phone_fixed', 100)->nullable(true);
            $table->longText('phone')->nullable(true);



            //Type Gender
            $table->enum('type_gender', ['MAS', 'FEM', 'NAN'])->nullable(true);
            /*
             * MAS: Masculino
             * FEM: Femenino
             * NAN: Sin especificar 
             */

            $table->boolean('is_disability')->default(0);
            $table->boolean('is_accounting')->default(0);
            $table->boolean('is_bond')->default(0);
            $table->boolean('is_old')->default(0);

            //Representative
            $table->string('firstname_representative', 100)->nullable(true);
            $table->string('lastname_representative', 100)->nullable(true);
            $table->string('fullname_representative', 100)->nullable(true);

            $table->longText('phone_representative')->nullable(true);

            $table->boolean('is_active')->default(1);

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
        Schema::dropIfExists('isp_customers');
    }
}
