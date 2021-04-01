<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('id_user')->nullable(false);
            $table->string('sentido', 100)->nullable(false)->default('entrante');
            $table->string('mensaje')->nullable(false)->default('');
            $table->string('contacto')->nullable(false)->default('');
            $table->timestamps();

            $table->unsignedBigInteger('id_chat');
            $table->foreign('id_chat')->references('id')->on('chats')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('messages');
    }
}
