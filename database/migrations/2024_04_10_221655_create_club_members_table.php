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
        Schema::create('club_members', function (Blueprint $table) {
            $table->id('cm_id');
            $table->string('cm_date_joined');
            $table->unsignedBigInteger('cm_u_id');
            $table->foreign('cm_u_id')->references('id')->on('users');
            $table->unsignedBigInteger('cm_c_id');
            $table->foreign('cm_c_id')->references('c_id')->on('clubs');
            $table->unsignedBigInteger('cm_mt_id');
            $table->foreign('cm_mt_id')->references('mt_id')->on('membership_types');
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
