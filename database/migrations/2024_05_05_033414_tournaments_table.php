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
        Schema::create('tournaments', function (Blueprint $table) {
            $table->id('tour_id');
            $table->string('tour_name');
            $table->text('tour_description');
            $table->unsignedBigInteger('tour_c_id');
            $table->string('tour_logo');
            $table->foreign('tour_c_id')->references('c_id')->on('clubs');
            $table->integer('tour_status')->default(0);
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
