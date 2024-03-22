<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDispositionAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('disposition_admins', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->unsignedInteger('user_id');
            $table->unsignedBigInteger('inbox_id');
            $table->unsignedInteger('receiver_id');
            $table->string('actions')->nullable();
            $table->text('description');
            $table->timestamps();

            $table->foreign('parent_id')
                ->references('id')
                ->on('disposition_admins');

            $table->foreign('user_id')
                ->references('id')
                ->on('users');

            $table->foreign('inbox_id')
                ->references('id')
                ->on('inboxes');

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
        Schema::dropIfExists('disposition_admins');
    }
}
