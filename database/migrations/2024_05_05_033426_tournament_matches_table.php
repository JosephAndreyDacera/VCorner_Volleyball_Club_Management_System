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
        Schema::create('matches', function (Blueprint $table) {
            $table->id('match_id');
            $table->unsignedBigInteger('match_tour_id');
            $table->foreign('match_tour_id')->references('tour_id')->on('tournaments');
            $table->unsignedBigInteger('match_team1');
            $table->foreign('match_team1')->references('t_id')->on('teams');
            $table->unsignedBigInteger('match_team2');
            $table->foreign('match_team2')->references('t_id')->on('teams');
            $table->string('match_date')->nullable();
            $table->string('match_time')->nullable();
            $table->string('match_location')->nullable();
            $table->string('match_description')->nullable();
            $table->unsignedBigInteger('match_winner')->nullable();
            $table->foreign('match_winner')->references('t_id')->on('teams');
            $table->unsignedBigInteger('match_loser')->nullable();
            $table->foreign('match_loser')->references('t_id')->on('teams');
            $table->integer('match_status')->default(0);
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
