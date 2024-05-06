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

        Schema::create('sets', function (Blueprint $table) {
            $table->id('set_id');
            $table->integer('set_number');
            $table->unsignedBigInteger('set_match_id');
            $table->foreign('set_match_id')->references('match_id')->on('matches');
            $table->integer('set_team1_score')->nullable();
            $table->integer('set_team2_score')->nullable();
            $table->unsignedBigInteger('set_winner')->nullable();
            $table->foreign('set_winner')->references('t_id')->on('teams');
            $table->unsignedBigInteger('set_loser')->nullable();
            $table->foreign('set_loser')->references('t_id')->on('teams');
            $table->integer('set_status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        Schema::dropIfExists('club_members');
    }
};
