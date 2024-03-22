<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArchiveBundleDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('archive_bundle_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('bundle_id');
            $table->unsignedBigInteger('archive_id');
            $table->unsignedInteger('approver_id')->nullable();
            $table->enum('status', ['p', 'r', 'a'])->nullable()->comment('p = process, r = reject, a = approved');
            $table->text('note')->nullable();
            $table->timestamps();

            $table->foreign('bundle_id')
                ->references('id')
                ->on('archive_bundles');

            $table->foreign('archive_id')
                ->references('id')
                ->on('archives');

            $table->foreign('approver_id')
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
        Schema::dropIfExists('archive_bundle_details');
    }
}
