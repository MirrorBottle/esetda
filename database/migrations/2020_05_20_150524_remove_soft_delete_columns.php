<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveSoftDeleteColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('agendas', function (Blueprint $table) {
            $table->dropColumn('deleted_at');
        });

        Schema::table('inboxes', function (Blueprint $table) {
            $table->dropColumn('deleted_at');
        });

        Schema::table('outboxes', function (Blueprint $table) {
            $table->dropColumn('deleted_at');
        });

        Schema::table('forwards', function (Blueprint $table) {
            $table->dropColumn('deleted_at');
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
    }
}
