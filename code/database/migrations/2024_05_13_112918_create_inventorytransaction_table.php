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
        Schema::create('inventorytransaction', function (Blueprint $table) {
            $table->bigIncrements('transaction_id');
            $table->unsignedBigInteger('resource_id');
            $table->foreign('resource_id')->references('resource_id')->on('inventory');
            $table->timestamps();
            $table->string('transaction_cat', length:255)->nullable();
            $table->integer('transaction_qty')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventorytransaction');
    }
};
