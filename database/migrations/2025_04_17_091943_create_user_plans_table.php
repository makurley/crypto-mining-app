<?php
Schema::create('user_plans', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained()->onDelete('cascade');
    $table->foreignId('plan_id')->constrained()->onDelete('cascade');
    $table->decimal('amount', 15, 2);
    $table->string('asset_type');
    $table->dateTime('starts_at');
    $table->dateTime('ends_at');
    $table->enum('status', ['active', 'expired'])->default('active');
    $table->timestamps();
});
