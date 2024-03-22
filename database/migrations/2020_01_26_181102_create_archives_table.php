<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArchivesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('archives', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('biro_id');
            $table->unsignedInteger('user_id');
            $table->morphs('archivable');
            $table->unsignedInteger('clasification_id')->nullable();
            $table->year('year')->nullable();
            $table->date('date');
            $table->boolean('tk_prk')->nullable()->comment('1 = COPY, 2 = ASLI');
            $table->integer('qty')->nullable();
            $table->integer('no_box')->nullable();
            $table->integer('no_folder')->nullable();
            $table->boolean('condition')->nullable()->comment('1 = BAIK, 0 = TIDAK BAIK');
            $table->text('note')->nullable();
            $table->boolean('is_attachment')->default(0);
            $table->enum('status', ['p', 'r', 'a'])->nullable()->comment('p = process, r = reject, a = approved');
            $table->timestamps();

            $table->foreign('biro_id')
                ->references('id')
                ->on('biros');

            $table->foreign('user_id')
                ->references('id')
                ->on('users');

            $table->foreign('clasification_id')
                ->references('id')
                ->on('clasifications');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('archives');
    }
}
