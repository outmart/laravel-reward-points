<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('outmart_reward_points', function (Blueprint $table) {
            $table->id();
            $table->morphs('modelble');
            $table->enum('type', ['add', 'withdraw'])->default('add');
            $table->integer('points');
            $table->text('comment')->nullable();
            $table->timestamp('expired_at')->nullable();
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
        Schema::dropIfExists('outmart_reward_points');
    }
};
