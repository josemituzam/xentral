<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('contextable_id')->nullable(true);
            $table->string('filename');
            $table->string('path', 500)->nullable(true);
            $table->string('extention', 50)->nullable(true);
            $table->string('type');
            $table->string('short_code', 5)->nullable(true);
            $table->string('long_code', 10)->nullable(true);
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
        Schema::dropIfExists('files');
    }
}
