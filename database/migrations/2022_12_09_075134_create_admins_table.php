<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('email',100)->unique();
            $table->string('user_name',100)->unique();
            $table->date('birthday');
            $table->string('first_name',100);
            $table->string('last_name',100);
            $table->string('password');
            $table->string('reset_password')->nullable();
            $table->string('status');
            $table->smallInteger('falg_delete')->default(0);
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
        Schema::dropIfExists('admins');
    }
};
