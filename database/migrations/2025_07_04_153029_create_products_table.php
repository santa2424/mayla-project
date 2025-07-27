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
       Schema::create('products', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('user_id');
        $table->unsignedInteger('quantity')->default(1); // Available quantity
        $table->string('name'); // اسم المنتج
        $table->text('description')->nullable(); // وصف
        $table->decimal('price', 8, 2); // السعر
        $table->string('image')->nullable(); // الصورة
      
         // تعريف المفاتيح الخارجية
            $table->foreignId('category_id')->constrained()->onDelete('cascade'); // الفئة
            $table->foreign('user_id')  ->references('id') ->on('users') ->onDelete('cascade');
             $table->timestamps();
        
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
