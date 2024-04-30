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
        Schema::create('club_access', function (Blueprint $table) {
            $table->id('ca_id');
            $table->unsignedBigInteger('ca_c_id');
            $table->foreign('ca_c_id')->references('c_id')->on('clubs');
            $table->unsignedBigInteger('ca_u_id');
            $table->foreign('ca_u_id')->references('id')->on('users');
            $table->integer('ca_members');
            $table->integer('ca_teams');
            $table->integer('ca_statistics');
            $table->integer('ca_events');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
