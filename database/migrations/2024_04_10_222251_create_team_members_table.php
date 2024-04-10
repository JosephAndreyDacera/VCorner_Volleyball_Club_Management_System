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
        Schema::create('team_members', function (Blueprint $table) {
            $table->id('tm_id');
            $table->unsignedBigInteger('tm_cm_id');
            $table->foreign('tm_cm_id')->references('cm_id')->on('club_members');
            $table->unsignedBigInteger('tm_t_id');
            $table->foreign('tm_t_id')->references('t_id')->on('teams');
            $table->unsignedBigInteger('tm_tmr_id');
            $table->foreign('tm_tmr_id')->references('tmr_id')->on('team_member_roles');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('team_members');
    }
};
