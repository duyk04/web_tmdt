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
        Schema::create('orders', function (Blueprint $table) {
            $table->id(); // Tạo khóa chính tự tăng
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Liên kết với bảng users
            $table->decimal('total', 15, 2); // Tổng hóa đơn
            $table->enum('status', ['processing', 'paid', 'cancelled'])->default('processing'); // Trạng thái thanh toán
            $table->enum('payment_method', ['COD', 'online'])->default('COD'); // Hình thức thanh toán
            $table->timestamps(); // Tạo cột created_at và updated_at
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
