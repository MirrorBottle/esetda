<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('inbox_id');
            $table->integer('letter_number');
            $table->date('letter_date');
            $table->unsignedBigInteger('skpd_id');
            $table->json('skpd_employee');
            $table->text('purpose');
            $table->string('place');
            $table->string('destination');
            $table->tinyInteger('duration');
            $table->date('departure_date');
            $table->date('return_date');
            $table->string('budget_expanse');
            $table->unsignedBigInteger('signer_id');
            $table->json('letter_signers')->nullable(); // paraf tambahan
            $table->boolean('is_accepted')->default(0);
            $table->timestamps();

            $table->foreign('inbox_id')->references('id')->on('inboxes');
            $table->foreign('skpd_id')->references('id')->on('skpds');
            $table->foreign('signer_id')->references('id')->on('spt_signers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('spts');
    }
}
