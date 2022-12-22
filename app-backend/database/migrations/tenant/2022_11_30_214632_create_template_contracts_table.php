<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTemplateContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('template_contracts', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name', 100)->nullable(true);
            $table->string('description', 300)->nullable(true);
            $table->string('orientation', 100)->nullable(true);

            $table->longText('html')->nullable(true);

            $table->string('size', 50)->nullable(true);
            $table->string('margin_left', 50)->nullable(true);
            $table->string('margin_right', 50)->nullable(true);
            $table->string('margin_bottom', 50)->nullable(true);
            $table->string('margin_top', 50)->nullable(true);

            $table->string('path', 500)->nullable(true);

            $table->string('template_code', 5)->nullable(true);
            $table->boolean('is_active')->default(true);
            $table->integer('orderBy')->nullable(true);
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
        Schema::dropIfExists('template_contracts');
    }
}
