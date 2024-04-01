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
        Schema::create('user_shops', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');

            $table->integer('shopunlocked')->default(0);
            $table->integer('shopitems')->default(0);

            $table->integer('reputationlevel')->default(0);
            $table->integer('reputation')->default(0);

            $table->unsignedBigInteger('shopitem1')->nullable();
            $table->unsignedBigInteger('shopitem2')->nullable();
            $table->unsignedBigInteger('shopitem3')->nullable();
            $table->unsignedBigInteger('shopitem4')->nullable();
            $table->unsignedBigInteger('shopitem5')->nullable();
            $table->unsignedBigInteger('shopitem6')->nullable();
            
            $table->foreign('shopitem1')->references('id')->on('items');
            $table->foreign('shopitem2')->references('id')->on('items');
            $table->foreign('shopitem3')->references('id')->on('items');
            $table->foreign('shopitem4')->references('id')->on('items');
            $table->foreign('shopitem5')->references('id')->on('items');
            $table->foreign('shopitem6')->references('id')->on('items');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_shops');
    }
};
