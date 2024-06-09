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
        Schema::create('patient', function (Blueprint $table) {
            $table->bigIncrements('patient_id');
            $table->unsignedBigInteger('hcworker_id');
            $table->foreign('hcworker_id')->references('id')->on('users');
            $table->string('patient_fname', length:255)->nullable();
            $table->string('patient_mname', length:255)->nullable();
            $table->string('patient_lname', length:255)->nullable();
            $table->string('patient_extension', length:255)->nullable();
            $table->string('patient_sex', length:255)->nullable();
            $table->date('patient_birthday')->nullable();
            $table->string('patient_barangay', length:255)->nullable();
            $table->string('patient_street', length:255)->nullable();
            $table->string('patient_cpnum', length:255)->nullable();
            $table->string('patient_bloodtype', length:255)->nullable();
            $table->string('patient_ec_lname', length:255)->nullable();
            $table->string('patient_ec_fname', length:255)->nullable();
            $table->string('patient_ec_mname', length:255)->nullable();
            $table->string('patient_ec_extension', length:255)->nullable();
            $table->string('patient_ec_cpnum', length:255)->nullable();
            $table->string('patient_ec_barangay', length:255)->nullable();
            $table->string('patient_ec_street', length:255)->nullable();
            $table->string('patient_ec_relationship', length:255)->nullable();
            $table->string('patient_period_status', length:255)->nullable();
            $table->string('patient_preg_status', length:255)->nullable();
            $table->timestamps();

        // Schema::table('patient', function($table) {
        //     $table->foreign('hcworker_id')->references('id')->on('users');
        //     // Other Constraints 
        // });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patient');
    }
};
