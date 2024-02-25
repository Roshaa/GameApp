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
        Schema::create('mobsmissions', function (Blueprint $table) {

            $table->id();
            $table->string('MobName');
            $table->integer('BaseHP');
            $table->integer('BaseDamage');
            $table->integer('MobTier');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mobs');
    }
};
