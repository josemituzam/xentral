<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_details', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id')->nullable(true);
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
            $table->date('birthday_at')->nullable(true);
            $table->string('cant_extra_time', 100)->nullable(true);
            $table->string('day_extra_time', 100)->nullable(true);
            $table->string('description', 300)->nullable(true);

            $table->string('address', 100)->nullable(true);
            $table->longText('phone')->nullable(true);
            //
            $table->uuid('zone_sale_id')->nullable(true);
            //
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
        Schema::dropIfExists('user_details');
    }
}
