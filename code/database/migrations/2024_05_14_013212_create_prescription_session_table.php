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
        Schema::create('prescription_session', function (Blueprint $table) {
            $table->bigIncrements('session_order_id');
            $table->unsignedBigInteger('session_id');
            $table->foreign('session_id')->references('session_id')->on('session');
            $table->string('session_order_medname', length:255)->nullable();
            $table->string('session_order_meddose', length:255)->nullable();
            $table->string('session_order_medfreq', length:255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prescription_session');
    }
};
