@extends('layouts.customer')
@section('title', 'Giỏ hàng của bạn')

@section('content')
<div class="container mt-5">
    <h1 class="text-center">Giỏ hàng của bạn</h1>

    @if ($message = Session::get('success'))
    <div class="alert alert-success mt-3">
        {{ $message }}
    </div>
    @endif

    @if (session('error'))
    <div class="alert alert-danger mt-3">
        {{ session('error') }}
    </div>
    @endif

    @if ($cartItems->count() > 0)
    <table class="table table-bordered mt-4 text-center align-middle">
        <thead class="table-dark">
            <tr>
                <th>Sản phẩm</th>
                <th>Ảnh</th>
                <th>Số lượng</th>
                <th>Giá</th>
                <th>Tổng</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cartItems as $item)
            <tr>
                <td class="align-middle">{{ $item->product->name }}</td>
                <td class="align-middle">
                    <img src="{{ asset('storage/' . $item->product->image) }}" alt="Ảnh sản phẩm" class="img-fluid" style="width: 80px; height: 80px;">
                </td>
                <td class="align-middle">
                    <form action="{{ route('customer.update.cart') }}" method="POST" class="d-inline-block">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $item->product_id }}">
                        <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" class="form-control" style="width: 60px; display: inline-block;">
                        <button type="submit" class="btn btn-info btn-sm mt-1">Cập nhật</button>
                    </form>
                </td>
                <td class="align-middle">{{ number_format($item->product->price, 0, ',', '.') }} VNĐ</td>
                <td class="align-middle">{{ number_format($item->product->price * $item->quantity, 0, ',', '.') }} VNĐ</td>
                <td class="align-middle">
                    <a href="{{ route('customer.cart.remove', $item->product_id) }}" class="btn btn-danger btn-sm">Xóa</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Tổng giá trị giỏ hàng -->
    <div class="row mt-4">
        <div class="col-md-6 offset-md-6">
            <div class="border p-3">
                <h5 class="text-end">Tổng giá trị: 
                    <strong>
                        {{ number_format($cartItems->sum(function ($item) { return $item->product->price * $item->quantity; }), 0, ',', '.') }} VNĐ
                    </strong>
                </h5>
                <a href="{{ route('customer.checkout.index') }}" class="btn btn-primary btn-block mt-2">Thanh toán</a>
            </div>
        </div>
    </div>
    
    @else
    <div class="alert alert-warning text-center mt-5">
        Giỏ hàng của bạn đang trống.
    </div>
    @endif
</div>
@endsection
