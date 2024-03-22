<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArchiveBundlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('archive_bundles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('sender_id');
            $table->unsignedInteger('biro_id');
            $table->enum('type', ['masuk', 'keluar']);
            $table->enum('status', ['p', 'r', 'a'])->default('p')->comment('p = process, r = reject, a = approved');
            $table->string('total', 3);
            $table->timestamps();

            $table->foreign('biro_id')
                ->references('id')
                ->on('biros');

            $table->foreign('sender_id')
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
        Schema::dropIfExists('archive_bundles');
    }
}
