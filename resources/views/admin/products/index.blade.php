@extends('layouts.admin')
@section('title', 'Quản lý sản phầm - Danh sách')
@section('content')
<h1>Danh sách sản phẩm</h1>

<a href="{{ route('admin.products.create') }}" class="btn btn-success mb-3">Thêm sản phẩm</a>
@if ($message = Session::get('success'))
            <div class="alert alert-success mt-3">
                {{ $message }}
            </div>
        @endif

<table class="table table-striped table-hover align-middle">
    <thead>
        <tr class="text-center">
            <th>Tên sản phẩm</th>
            <th>Mô tả</th>
            <th>Hãng sản xuất</th>
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
                    <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-warning">Sửa</a>
                    <form action="{{ route('admin.products.destroy', $product) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Xóa</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

@endsection