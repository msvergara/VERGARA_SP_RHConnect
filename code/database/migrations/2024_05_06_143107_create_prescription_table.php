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
        Schema::create('prescription', function (Blueprint $table) {
            $table->bigIncrements('patient_medid');
            $table->unsignedBigInteger('patient_cat_id');
            $table->foreign('patient_cat_id')->references('patient_ill_id')->on('illness');
            $table->string('patient_medname', length:255)->nullable();
            $table->string('patient_meddose', length:255)->nullable();
            $table->string('patient_medfreq', length:255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prescription');
    }
};
