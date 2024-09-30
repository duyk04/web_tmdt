@extends('layouts.customer')
@section('title', 'Quản lý sản phầm - Danh sách')
@section('content')

<h1 class="text-center">Danh sách sản phẩm</h1>

<!-- <a href="{{ route('products.create') }}" class="btn btn-success mb-3">Thêm sản phẩm</a> -->
@if ($message = Session::get('success'))
<div class="alert alert-success mt-3">
    {{ $message }}
</div>
@endif

@if ($message = Session::get('error'))
<div class="alert alert-danger mt-3">
    {{ $message }}
</div>
@endif

<div class="row mt-4">
    @foreach ($products as $product)
    <div class="col-md-2 text-center card card_products">
        <div class="img-product">
            <img src="{{ asset('storage/' . $product->image) }}" alt="Ảnh sản phẩm" class="w-100">
        </div>
        <div>
            <p class="pt-5 name_products">{{ $product->name }}</p><br />
            <p class="pt-0 mt-0">{{ $product->price }} VNĐ</p>
            <!-- <a href="{{ route('customer.add.to.cart', $product->id) }}"> <button class="btn btn-primary">Thêm vào giỏ hàng</button></a> -->
            <form action="{{ route('customer.add.to.cart', ['id' => $product->id]) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary">Thêm vào giỏ hàng</button>
            </form>
        </div>
    </div>
    @endforeach
</div>
<!-- <table class="table table-striped table-hover align-middle">
    <thead>
        <tr class="text-center">
            <th>Tên sản phẩm</th>
            <th>Mô tả</th>
            <th>Danh mục</th>
            <th>Số lượng</th>
            <th>Giá</th>
            <th>Ảnh</th>
            <th>Thao tác</th>
        </tr>
    </thead>
    <tbody class="text-center">
        @foreach ($products as $product)
        <tr>
            <td>{{ $product->name }}</td>
            <td>{{ $product->describe }}</td>
            <td>{{ $product->manufacturer->name }}</td>
            <td>{{ $product->quantity }}</td>
            <td>{{ $product->price }}</td>
            <td><img src="{{ asset('storage/' . $product->image) }}" alt="Ảnh sản phẩm" width="100" height="100"></td>
            <td>
                <a href="{{ route('products.edit', $product) }}" class="btn btn-warning">Sửa</a>
                <form action="{{ route('products.destroy', $product) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Xóa</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table> -->

@endsection