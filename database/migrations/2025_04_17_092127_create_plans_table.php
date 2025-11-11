<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('hashrate');
            $table->decimal('price', 15, 2);
            $table->string('asset_type'); // You can also create a relation to assets table if needed
            $table->integer('duration_months');
            $table->enum('roi_type', ['percentage', 'fixed']);
            $table->decimal('roi_value', 15, 2);
            $table->enum('badge', ['popular', 'recommended', 'starters'])->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('plans');
    }
};
