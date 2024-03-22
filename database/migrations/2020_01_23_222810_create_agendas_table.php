<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgendasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agendas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date');
            $table->time('time_start');
            $table->time('time_end');
            $table->text('event');
            $table->unsignedBigInteger('inbox_id')->nullable()->comment('surat masuk jika terhubung');
            $table->unsignedInteger('user_id')->comment('user yg input');
            $table->unsignedInteger('place_id');
            $table->unsignedInteger('apparel_id');
            $table->unsignedInteger('disposition_id');
            $table->unsignedInteger('receiver_id');
            $table->boolean('status')->default(1)->comment('0 = rahasia, 1 = terbuka');
            $table->text('description')->nullable();
            $table->boolean('is_attachment')->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('inbox_id')
                ->references('id')
                ->on('inboxes');

            $table->foreign('user_id')
                ->references('id')
                ->on('users');

            $table->foreign('place_id')
                ->references('id')
                ->on('agenda_places');

            $table->foreign('apparel_id')
                ->references('id')
                ->on('agenda_apparels');

            $table->foreign('disposition_id')
                ->references('id')
                ->on('agenda_dispositions');

            $table->foreign('receiver_id')
                ->references('id')
                ->on('agenda_receivers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agendas');
    }
}
