<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWaBotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wa_bots', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('number');
            $table->string('message');
            $table->unsignedBigInteger('visitor_id')->nullable();
            $table->string('my_number');
            $table->string('keyword');
            $table->string('port');
            $table->string('ip_server');
            $table->boolean('status')->default(0)->comment('sudah kirim atau belum');
            $table->timestamps();

            $table->foreign('visitor_id')
                ->references('id')
                ->on('visitors');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wa_bots');
    }
}
