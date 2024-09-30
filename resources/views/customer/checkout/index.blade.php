@extends('layouts.customer')
@section('title', 'Thanh toán')

@section('content')
<h1 class="text-center">Trang Thanh Toán</h1>

@if ($message = Session::get('error'))
    <div class="alert alert-danger">{{ $message }}</div>
@endif

<form action="{{ route('customer.checkout.process') }}" method="POST">
    @csrf
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Sản phẩm</th>
                <th>Số lượng</th>
                <th>Giá</th>
                <th>Tổng</th>
            </tr>
        </thead>
        <tbody>
            @php $total = 0; @endphp
            @foreach ($cartItems as $item)
                <tr>
                    <td>{{ $item->product->name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ $item->product->price }} VNĐ</td>
                    <td>{{ $item->quantity * $item->product->price }} VNĐ</td>
                </tr>
                @php $total += $item->quantity * $item->product->price; @endphp
            @endforeach
        </tbody>
    </table>

    <h3>Tổng cộng: {{ $total }} VNĐ</h3>
    <input type="hidden" name="total" value="{{ $total }}">

    <div class="form-group">
        <label for="payment_method">Chọn hình thức thanh toán:</label>
        <select name="payment_method" class="form-control">
            <option value="COD">Thanh toán khi nhận hàng (COD)</option>
            <option value="online">Thanh toán online</option>
        </select>
    </div>

    <button type="submit" class="btn btn-success">Xác nhận thanh toán</button>
</form>
@endsection
