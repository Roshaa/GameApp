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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('itemname');
            $table->unsignedBigInteger('user_owner_id');
            $table->foreign('user_owner_id')->references('id')->on('users');
            $table->integer('stat1');
            $table->integer('stat2');
            $table->integer('stat3');
            $table->integer('stat4');
            $table->integer('stat5');
            $table->integer('specialeffect1');
            $table->integer('specialeffect2');
            $table->integer('specialeffect3');
            $table->integer('specialeffect4');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
