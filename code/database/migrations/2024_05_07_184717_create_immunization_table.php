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
        Schema::create('immunization', function (Blueprint $table) {
            $table->bigIncrements('patient_immu_id');
            $table->unsignedBigInteger('patient_id');
            $table->foreign('patient_id')->references('patient_id')->on('patient');
            $table->string('patient_immu_date', length:255)->nullable();
            $table->string('patient_immu_name', length:255)->nullable();
            $table->string('patient_immu_cat', length:255)->nullable();
            $table->string('patient_immu_reax', length:255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('immunization');
    }
};
