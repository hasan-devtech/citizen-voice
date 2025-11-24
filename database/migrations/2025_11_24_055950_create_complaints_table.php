<?php

use App\Enums\ComplaintStatusEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('complaints', function (Blueprint $table) {
            $table->id();
            $table->foreignId('complainant_id')->constrained();
            $table->foreignId('complaint_category_id')->constrained();
            $table->foreignId('agency_id')->constrained();
            $table->foreignId('location_id')->constrained();
            $table->string('reference_number', 50)->unique();
            $table->string('title');
            $table->text('description');
            $table->enum('status', enumValues(ComplaintStatusEnum::class))->default(ComplaintStatusEnum::PENDING);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('complaints');
    }
};
