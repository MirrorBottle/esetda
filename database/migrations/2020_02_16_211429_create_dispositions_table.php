<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDispositionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dispositions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('user_id');
            $table->unsignedBigInteger('inbox_id');
            $table->string('no_agenda');
            $table->integer('kop');
            $table->integer('ttd')->nullable();
            $table->integer('property');
            $table->string('sender');
            $table->dateTime('date_time_receipt')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();

            $table->foreign('inbox_id')
                ->references('id')
                ->on('inboxes');

            $table->foreign('user_id')
                ->references('id')
                ->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dispositions');
    }
}
