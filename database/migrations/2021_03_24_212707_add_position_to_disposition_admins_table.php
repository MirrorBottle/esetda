<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPositionToDispositionAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('disposition_admins', function (Blueprint $table) {
            $table->string('position')->nullable()->after('description'); // nomor agenda
            $table->string('unique_key')->nullable()->after('position'); // unique key dari visitor / inbox
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('disposition_admins', function (Blueprint $table) {
            //
        });
    }
}
