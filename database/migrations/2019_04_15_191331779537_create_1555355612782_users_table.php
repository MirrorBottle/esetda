<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Create1555355612782UsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('type')->default(1)->comment('0 = super, 1 = esetda, 2 = eagenda, 3 = earsip');
            $table->unsignedInteger('biro_id')->nullable();
            $table->unsignedInteger('receiver_id')->nullable();
            $table->string('username', 40)->unique();
            $table->string('name');
            $table->string('email')->unique();
            $table->datetime('email_verified_at')->nullable();
            $table->string('password');
            $table->string('remember_token')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('biro_id')
                ->references('id')
                ->on('biros');
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}
