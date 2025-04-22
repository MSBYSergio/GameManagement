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
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table -> string('stripe_id') -> nullable();
            $table -> string('stripe_price_id') -> nullable();
            $table->string('image');
            $table->string('name')->unique();
            $table->decimal('price', 4, 2);
            $table->boolean('discount');
            $table->decimal('discount_price', 4, 2) -> nullable();
            $table->text('description');
            $table->date('release_date');
            $table->string('developer');
            $table->text('requirements');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};
