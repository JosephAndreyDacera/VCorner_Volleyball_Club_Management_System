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
        Schema::create('membership_requests', function (Blueprint $table) {
            $table->id('mr_id');
            $table->unsignedBigInteger('mr_u_id');
            $table->foreign('mr_u_id')->references('id')->on('users');
            $table->unsignedBigInteger('mr_c_id');
            $table->foreign('mr_c_id')->references('c_id')->on('clubs');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('membership_requests');
    }
};
