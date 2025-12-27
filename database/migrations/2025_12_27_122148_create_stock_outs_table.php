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
Schema::create('stock_outs', function (Blueprint $table) {
    $table->id();
    $table->string('trx_no')->unique();
    $table->date('date');
    $table->string('type')->default('sale'); // sale/service
    $table->string('customer_name')->nullable();
    $table->decimal('total', 15, 2)->default(0);
    $table->text('note')->nullable();
    $table->foreignId('created_by')->constrained('users')->cascadeOnDelete();
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_outs');
    }
};
