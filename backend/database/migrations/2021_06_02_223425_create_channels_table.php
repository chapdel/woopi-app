<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChannelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('channels', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('uid')->nullable()->unique();
            $table->string('description', 2048)->nullable();
            $table->string('poster', 2048)->nullable();
            $table->foreignId('user_id')->constrained();
            $table->enum('visibility', ['public', 'private', 'protected'])->default('public');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('channels');
    }
}
