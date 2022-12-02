<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApiR2STable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('api_r2_s', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('bucket_name', 100)->nullable(true);
            $table->string('account_id', 64)->nullable(true);
            $table->string('access_key_id', 100)->nullable(true);
            $table->string('access_key_secret', 100)->nullable(true);
            $table->string('key_image_name', 100)->nullable(true);
            $table->string('key_file_name', 100)->nullable(true);
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
        Schema::dropIfExists('api_r2_s');
    }
}
