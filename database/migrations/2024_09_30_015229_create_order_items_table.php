<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id(); // Tạo khóa chính tự tăng
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade'); // Liên kết với bảng orders
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade'); // Liên kết với bảng products
            $table->integer('quantity'); // Số lượng sản phẩm
            $table->decimal('price', 15, 2); // Giá mỗi sản phẩm tại thời điểm mua
            $table->timestamps(); // Tạo cột created_at và updated_at
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
