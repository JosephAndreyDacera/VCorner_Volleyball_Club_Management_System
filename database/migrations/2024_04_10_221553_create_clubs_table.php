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
        Schema::create('clubs', function (Blueprint $table) {
            $table->id('c_id');
            $table->string('c_name');
            $table->string('c_date_founded');
            $table->string('c_address');
            $table->string('c_logo')->nullable();
            $table->string('c_email');
            $table->string('c_mobile');
            $table->string('c_facebook')->nullable();
            $table->string('c_instagram')->nullable();
            $table->string('c_x')->nullable();
            $table->string('c_youtube')->nullable();
            $table->string('c_website')->nullable();
            $table->string('c_invite_code');
            $table->unsignedBigInteger('c_u_id');
            $table->foreign('c_u_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clubs');
    }
};
