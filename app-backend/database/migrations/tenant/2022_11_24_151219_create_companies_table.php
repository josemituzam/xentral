<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name_company', 100)->nullable(true);
            $table->string('country', 100)->nullable(true);
            $table->string('name_commercial', 100)->nullable(true);
            $table->string('type_identification', 100)->nullable(true);
            $table->string('identification', 100)->nullable(true);
            $table->boolean('is_accounting')->default(true);
            $table->boolean('is_special')->default(true);
            $table->string('address', 100)->nullable(true);
            $table->longText('phone_principal')->nullable(true);
            $table->longText('phone_secondary')->nullable(true);
            $table->longText('break_day')->nullable(true);
            $table->string('decimal', 100)->nullable(true);
            $table->string('google_key', 100)->nullable(true);
            $table->string('electronic_signature', 100)->nullable(true);
            $table->boolean('is_active')->default(true);
            $table->string('short_code', 5)->nullable(true);
            $table->string('long_code', 50)->nullable(true);
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
        Schema::dropIfExists('companies');
    }
}
