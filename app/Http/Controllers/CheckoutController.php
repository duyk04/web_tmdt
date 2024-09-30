<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    // Hiển thị trang thanh toán
    public function showCheckout()
    {
        $userId = Auth::id();
        $cartItems = Cart::with('product')->where('user_id', $userId)->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('customer.cart.index')->with('error', 'Giỏ hàng của bạn rỗng.');
        }

        return view('customer.checkout.index', compact('cartItems'));
    }

    // Xử lý thanh toán
    public function processCheckout(Request $request)
    {
        $request->validate([
            'payment_method' => 'required|in:COD,online',
        ]);

        DB::beginTransaction();
        try {
            // Tạo đơn hàng
            $order = Order::create([
                'user_id' => Auth::id(),
                'total' => $request->total,
                'status' => 'processing',
                'payment_method' => $request->payment_method,
            ]);

            // Lưu thông tin sản phẩm trong giỏ hàng vào order_items
            $cartItems = Cart::with('product')->where('user_id', Auth::id())->get();

            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price,
                ]);
            }

            // Xóa giỏ hàng sau khi thanh toán
            Cart::where('user_id', Auth::id())->delete();

            DB::commit();

            return redirect()->route('customer.checkout.success')->with('success', 'Thanh toán thành công!');
        } catch (\Exception $e) {
            DB::rollBack();
            // return redirect()->back()->with('error', 'Đã có lỗi xảy ra trong quá trình thanh toán.');
            return redirect()->back()->with('error', 'Đã có lỗi xảy ra: ' . $e->getMessage());
        }
    }

    // Hiển thị trang thành công
    public function checkoutSuccess()
    {
        return view('customer.checkout.success');
    }
}
