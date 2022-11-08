<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       // \Illuminate\Support\Facades\DB::statement('SET SESSION sql_require_primary_key=0');
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->timestamp('last_login_at')->nullable();
            //$table->uuid('status_id')->nullable(false);
            $table->string('confirm_account_token')->nullable();
            $table->string('confirm_account_token_time')->nullable();
            $table->string('reset_password_token')->nullable();
            $table->string('reset_password_token_time')->nullable();
            $table->boolean('force_password_change')->default(false);
            $table->rememberToken();
            $table->uuid('created_by')->nullable(true);
            $table->uuid('updated_by')->nullable(true);
            $table->uuid('deleted_by')->nullable(true);
            //$table->index('status_id', 'status_id_index');
            $table->softDeletes();
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
        Schema::dropIfExists('users');
    }
}
