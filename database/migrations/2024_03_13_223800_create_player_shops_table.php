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
        Schema::create('player_shops', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            
            $table->unsignedBigInteger('item1'); 
            $table->unsignedBigInteger('item2');
            $table->unsignedBigInteger('item3');
            $table->unsignedBigInteger('item4');
            $table->unsignedBigInteger('item5');
            $table->unsignedBigInteger('item6');

            $table->foreign('item1')->references('id')->on('Items')->onDelete('cascade');
            $table->foreign('item2')->references('id')->on('Items')->onDelete('cascade');
            $table->foreign('item3')->references('id')->on('Items')->onDelete('cascade');
            $table->foreign('item4')->references('id')->on('Items')->onDelete('cascade');
            $table->foreign('item5')->references('id')->on('Items')->onDelete('cascade');
            $table->foreign('item6')->references('id')->on('Items')->onDelete('cascade');

            $table->integer('shopupgrade1')->default(0);    
            $table->integer('shopupgrade2')->default(0);    
            $table->integer('shopupgrade3')->default(0);    
            $table->integer('shopupgrade4')->default(0);    

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('player_shops');
    }
};
