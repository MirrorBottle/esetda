<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArchiveInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('archive_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('biro_id');
            $table->unsignedInteger('user_id');
            $table->morphs('archivable');
            $table->date('date');
            $table->boolean('is_archived')->default(0);
            $table->timestamps();

            $table->foreign('biro_id')
                ->references('id')
                ->on('biros');

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
        Schema::dropIfExists('archive_infos');
    }
}
