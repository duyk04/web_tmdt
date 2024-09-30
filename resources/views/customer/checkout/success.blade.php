@extends('layouts.customer')
@section('title', 'Thanh toán thành công')

@section('content')
<h1 class="text-center">Thanh toán thành công!</h1>
<p class="text-center">Cảm ơn bạn đã mua sắm tại cửa hàng của chúng tôi!</p>
<a href="{{ route('customer.products.index') }}" class="btn btn-primary">Tiếp tục mua sắm</a>
@endsection
