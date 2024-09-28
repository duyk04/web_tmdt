@extends('layouts.customer')
@section('title', 'Giỏ hàng của bạn')


@section('content')
<h1 class="text-center">Giỏ hàng của bạn</h1>
@if ($message = Session::get('success'))
<div class="alert alert-success mt-3">
    {{ $message }}
</div>
@endif

@if (session('cart'))
<table class="table table-bordered">
    <thead>
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
        @foreach (session('cart') as $id => $details)
        <tr>
            <td>{{ $details['name'] }}</td>
            <td>
                <img src="{{ asset('storage/' . $details['image']) }}" alt="Ảnh sản phẩm" width="80" height="80">
            </td>
            <td>{{ $details['quantity'] }}</td>
            <td>{{ $details['price'] }} VNĐ</td>
            <td>{{ $details['price'] * $details['quantity'] }} VNĐ</td>
            <td>
                <!-- Form cập nhật số lượng -->
                <form action="{{ route('customer.update.cart') }}" method="POST" style="display: inline-block;">
                    @csrf
                    <input type="hidden" name="id" value="{{ $id }}">
                    <input type="number" name="quantity" value="{{ $details['quantity'] }}" min="1" style="width: 50px;">
                    <button type="submit" class="btn btn-info">Cập nhật</button>
                </form>
                <!-- Link xóa sản phẩm -->
                <a href="{{ route('customer.cart.remove', $id) }}" class="btn btn-danger">Xóa</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@else
<h3 class="text-center">Giỏ hàng rỗng</h3>
@endif
@endsection