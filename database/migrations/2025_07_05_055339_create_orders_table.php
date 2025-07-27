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
         Schema::create('orders', function (Blueprint $table) {
    $table->id();
    $table->unsignedBigInteger('user_id'); // ربط الطلب بالمستخدم
    $table->string('customer_name');
    $table->decimal('total', 10, 2);
    $table->enum('status', ['Pending', 'Completed', 'Cancelled'])->default('Pending');
    $table->string('payment_method')->default('cash'); // طريقة الدفع
    $table->date('order_date')->nullable(); // أو ممكن تخليها nullable وتضعي التاريخ تلقائياً في الكود
    $table->timestamps(); 

    // المفتاح الأجنبي للمستخدم
    $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
