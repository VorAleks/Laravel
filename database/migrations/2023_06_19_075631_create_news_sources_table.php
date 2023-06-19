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
        Schema::create('news_sources', function (Blueprint $table) {
            $table->foreignId('news_id')
                ->references('id')
                ->on('news')
                ->cascadeOnDelete();

            $table->foreignId('source_id')
                ->references('id')
                ->on('sources')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news_sources');
    }
};
