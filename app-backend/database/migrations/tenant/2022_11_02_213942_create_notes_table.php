<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notes', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('note', 300)->nullable(false);
            $table->string('module_short_code', 10)->nullable(false);
            $table->uuid('reference_id')->nullable(false);
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
        Schema::dropIfExists('notes');
    }
}
