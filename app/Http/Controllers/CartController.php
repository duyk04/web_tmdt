<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Thêm sản phẩm vào giỏ hàng
    public function addToCart(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);
        $userId = Auth::id(); // Lấy ID người dùng hiện tại

        // Kiểm tra xem sản phẩm đã có trong giỏ hàng của user chưa
        $cartItem = Cart::where('user_id', $userId)
                        ->where('product_id', $productId)
                        ->first();

        if ($cartItem) {
            // Nếu có rồi, tăng số lượng
            $cartItem->quantity++;
            $cartItem->save();
        } else {
            // Nếu chưa có, thêm sản phẩm vào giỏ hàng
            Cart::create([
                'user_id' => $userId,
                'product_id' => $productId,
                'quantity' => 1,
            ]);
        }

        return redirect()->back()->with('success', 'Sản phẩm đã được thêm vào giỏ hàng!');
    }

    // Hiển thị giỏ hàng
    public function cart()
    {
        $userId = Auth::id(); // Lấy ID người dùng hiện tại
        $cartItems = Cart::with('product') // Lấy cả thông tin sản phẩm từ quan hệ
                        ->where('user_id', $userId)
                        ->get();

        return view('customer.cart.index', compact('cartItems'));
    }

    // Cập nhật số lượng sản phẩm trong giỏ hàng
    public function updateCart(Request $request)
    {
        $userId = Auth::id(); // Lấy ID người dùng hiện tại

        $cartItem = Cart::where('user_id', $userId)
                        ->where('product_id', $request->product_id)
                        ->first();

        if ($cartItem) {
            $cartItem->quantity = $request->quantity;
            $cartItem->save();
            return redirect()->back()->with('success', 'Giỏ hàng đã được cập nhật');
        }

        return redirect()->back()->with('error', 'Sản phẩm không tồn tại trong giỏ hàng');
    }

    // Xóa sản phẩm khỏi giỏ hàng
    public function removeFromCart($productId)
    {
        $userId = Auth::id(); // Lấy ID người dùng hiện tại

        Cart::where('user_id', $userId)
            ->where('product_id', $productId)
            ->delete();

        return redirect()->back()->with('success', 'Sản phẩm đã được xóa khỏi giỏ hàng');
    }
}
