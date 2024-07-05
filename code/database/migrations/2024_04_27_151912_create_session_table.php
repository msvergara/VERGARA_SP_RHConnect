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
        Schema::create('session', function (Blueprint $table) {
            $table->bigIncrements('session_id');
            $table->unsignedBigInteger('appointment_id');
            $table->foreign('appointment_id')->references('appointment_id')->on('appointments');
            $table->string('session_px_bp')->nullable();
            $table->string('session_px_temperature')->nullable();
            $table->string('session_px_heartrate')->nullable();
            $table->string('session_px_respiratoryrate')->nullable();
            $table->string('session_px_oxygensat')->nullable();
            $table->string('session_px_height')->nullable();
            $table->string('session_px_weight')->nullable();
            $table->string('session_complaint')->nullable();
            $table->string('session_findings')->nullable();
            $table->string('session_treatment')->nullable();
            // $table->string('session_order')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('session');
    }
};
