<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSkpdEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skpd_employees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('skpd_id');
            $table->string('name');
            $table->string('position');
            $table->string('group')->nullable();
            $table->string('nip')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('skpd_id')->references('id')->on('skpds');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('skpd_employees');
    }
}
