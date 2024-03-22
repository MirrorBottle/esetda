<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVisitorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visitors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('sender');
            $table->string('institution');
            $table->string('whatsapp')->nullable();
            $table->string('email')->nullable();
            $table->string('letter_no')->nullable();
            $table->string('letter_title');
            $table->unsignedInteger('receiver_id');
            $table->text('description')->nullable();
            $table->enum('status', ['B','P','S','T'])->default('B')->comment('B=Belum, P=Proses, S=Selesai, T=Tolak');
            $table->timestamps();

            $table->foreign('receiver_id')
                ->references('id')
                ->on('receivers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('visitors');
    }
}
