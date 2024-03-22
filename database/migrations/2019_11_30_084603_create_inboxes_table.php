<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInboxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inboxes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('biro_id');
            $table->unsignedInteger('user_id');
            $table->string('no');
            $table->string('title');
            $table->date('date')->nullable();
            $table->date('date_entry');
            $table->unsignedInteger('category_id');
            $table->unsignedInteger('receiver_id');
            $table->text('description')->nullable();
            $table->boolean('is_forwarded')->default(0);
            $table->boolean('is_attachment')->default(0);
            $table->boolean('is_archived')->nullable()->comment('0 = blm di approve, 1 = sudah di approve');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('biro_id')
                ->references('id')
                ->on('biros');

            $table->foreign('user_id')
                ->references('id')
                ->on('users');

            $table->foreign('category_id')
                ->references('id')
                ->on('categories');

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
        Schema::dropIfExists('inboxes');
    }
}
