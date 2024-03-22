<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForwardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forwards', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('biro_id');
            $table->unsignedInteger('user_id')->comment('operator');
            $table->unsignedBigInteger('inbox_id')->nullable();
            $table->unsignedBigInteger('outbox_id')->nullable();
            $table->text('note')->nullable();
            $table->boolean('is_received')->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('inbox_id')
                ->references('id')
                ->on('inboxes');

            $table->foreign('outbox_id')
                ->references('id')
                ->on('outboxes');

            $table->foreign('user_id')
                ->references('id')
                ->on('users');

            $table->foreign('biro_id')
                ->references('id')
                ->on('biros');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('forwards');
    }
}
