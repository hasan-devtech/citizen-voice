<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('agencies', function (Blueprint $table) {
            $table->id();
            $table->string('name_ar', 127);
            $table->string('name_en', 127);
            $table->string('name_ku', 127);
            $table->string('description_en')->nullable();
            $table->string('description_ar')->nullable();
            $table->string('description_ku')->nullable();
            $table->foreignId('parent_id')->nullable()->constrained('agencies')->cascadeOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agencies');
    }
};
