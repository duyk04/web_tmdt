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
            $table->string('name'); // Tên sản phẩm
            $table->text('describe'); // Mô tả sản phẩm
            $table->integer('quantity'); // Số lượng sản phẩm
            $table->float('price'); // Giá sản phẩm
            $table->string('image'); // Đường dẫn ảnh sản phẩm
            $table->unsignedBigInteger('manufacturer_id'); // Khóa ngoại
    
            $table->foreign('manufacturer_id')->references('id')->on('manufacturers')->onDelete('cascade');
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
