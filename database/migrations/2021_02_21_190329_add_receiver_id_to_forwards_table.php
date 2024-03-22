<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddReceiverIdToForwardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('forwards', function (Blueprint $table) {
            $table->unsignedInteger('receiver_id')->nullable()->after('outbox_id');

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
        Schema::table('forwards', function (Blueprint $table) {
            //
        });
    }
}
