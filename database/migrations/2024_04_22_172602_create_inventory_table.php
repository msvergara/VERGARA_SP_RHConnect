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
        Schema::create('inventory', function (Blueprint $table) {
            $table->bigIncrements('resource_id');
            $table->timestamps();
            $table->string('resource_name', length:255)->nullable();
            $table->string('resource_category', length:255)->nullable();
            $table->integer('resource_stocks')->nullable();
            $table->string('resource_notes', length:255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory');
    }
};
