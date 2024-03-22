<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLetterNumberUsedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('letter_number_useds', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('letter_number_id');
            $table->string('number');
            $table->string('sender');
            $table->integer('order');
            $table->string('attachment')->nullable();
            $table->text('note')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('letter_number_id')
                ->references('id')
                ->on('letter_numbers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('letter_number_useds');
    }
}
