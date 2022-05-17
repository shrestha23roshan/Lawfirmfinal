<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('role_id')->unsigned();
            $table->string('username')->nullable()->default(null);
            $table->string('password')->nullable()->default(null);
            $table->string('full_name')->nullable()->default(null);
            $table->string('designation')->nullable()->default(null);
            $table->enum('is_active', [0,1])->default(0);
            $table->string('image_icon')->nullable()->default(null);
            $table->rememberToken();
            $table->nullableTimestamps();

            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade'); 
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
