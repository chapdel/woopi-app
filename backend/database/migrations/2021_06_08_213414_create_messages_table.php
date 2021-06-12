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
            $table->id();
            $table->longText('content')->nullable();
            $table->string('uid')->unique();
            $table->string('fuid')->nullable()->unique();
            $table->foreignId('user_id')->nullable()->constrained();
            $table->foreignId('room_id')->nullable()->constrained();
            $table->enum('type', ['system', 'default'])->default('default');
            $table->timestamps();
            $table->softDeletes();
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
