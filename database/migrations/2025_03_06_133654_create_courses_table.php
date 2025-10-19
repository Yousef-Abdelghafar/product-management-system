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
        // هنا غيرنا اسم الجدول لـ products وزودنا الحقول المطلوبة
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');        // حقل الوصف
            $table->decimal('price', 8, 2);   // حقل السعر
            $table->integer('quantity');        // حقل الكمية
            $table->string('image')->nullable(); // حقل الصورة (وخليناه اختياري)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // لازم نغير دي كمان لـ products
        Schema::dropIfExists('products');
    }
};
