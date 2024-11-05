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
        Schema::create('quest_trackers', function (Blueprint $table) {
            $table->id('TrackerID');
            $table->date('QuestCompletedDate')->nullable();
            $table->boolean('QuestAvailable');
            $table->unsignedBigInteger('UserID');
            $table->integer('QuestProgress')->default(0);

            $table->foreign('UserID')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quest_trackers');
    }
};
