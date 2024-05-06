<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //
        Schema::create('tour_stats', function (Blueprint $table) {
            $table->id('ts_id');
            $table->unsignedBigInteger('ts_player_id');
            $table->foreign('ts_player_id')->references('id')->on('users');
            $table->unsignedBigInteger('ts_tour_id');
            $table->foreign('ts_tour_id')->references('tour_id')->on('tournaments');
            $table->integer('attacks_total')->default(0);
            $table->integer('attacks_kill')->default(0);
            $table->integer('attacks_error')->default(0);
            $table->integer('service_total')->default(0);
            $table->integer('service_ace')->default(0);
            $table->integer('service_error')->default(0);
            $table->integer('blocks_total')->default(0);
            $table->integer('blocks_point')->default(0);
            $table->integer('total_recieves')->default(0);
            $table->integer('total_digs')->default(0);
            $table->integer('total_sets')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('club_members');
    }
};
