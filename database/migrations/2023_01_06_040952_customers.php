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
        //
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('email', 100)->nullable(true)->unique();
            $table->string('phone', 11)->unique();
            $table->date('birthday');
            $table->string('full_name', 100);
            $table->string('password');
            $table->string('reset_password')->nullable(true);
            $table->string('address', 255);
            $table->bigInteger('province_id', false, true)->nullable();
            $table->bigInteger('district_id', false, true)->nullable();
            $table->bigInteger('commune_id', false, true)->nullable();
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('flag_delete')->default(0);
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
        //
        Schema::dropIfExists('customers');
    }
};
