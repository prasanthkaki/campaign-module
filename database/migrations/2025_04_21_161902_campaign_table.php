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
        Schema::create('campaign', function(Blueprint $table) {
            $table->id();
            $table->string('title')->index('idx_campaign_title');
            $table->text('description');
            $table->text('targetLink')->index('idx_campaign_targetLink');
            $table->date('scheduleDate')->index('idx_campaign_scheduleDate');
            $table->dateTime('createDateTime')->default(now());
            $table->dateTime('modifyDateTime')->default(now());
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campaign');
    }
};
