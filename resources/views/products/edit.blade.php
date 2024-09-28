@extends('layouts.app')
@section('title', 'Quản lý sản phầm - Sửa')
@section('content')
    <h1>Sửa sản phẩm: {{ $product->name }}</h1>

    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Tên sản phẩm</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $product->name }}" required>
        </div>

        <div class="form-group">
            <label for="describe">Mô tả sản phẩm</label>
            <textarea class="form-control" id="describe" name="describe" required>{{ $product->describe }}</textarea>
        </div>

        <div class="form-group">
            <label for="quantity">Số lượng</label>
            <input type="number" class="form-control" id="quantity" name="quantity" value="{{ $product->quantity }}" required>
        </div>

        <div class="form-group">
            <label for="price">Giá</label>
            <input type="text" class="form-control" id="price" name="price" value="{{ $product->price }}" required>
        </div>

        <div class="form-group">
            <label for="image">Ảnh sản phẩm</label>
            <input type="file" class="form-control" id="image" name="image">
            <img src="{{ asset('storage/' . $product->image) }}" alt="Ảnh sản phẩm" width="100">
        </div>

        <div class="form-group">
            <label for="manufacturer_id">Hãng sản xuất</label>
            <select class="form-control" id="manufacturer_id" name="manufacturer_id" required>
                @foreach ($manufacturers as $manufacturer)
                    <option value="{{ $manufacturer->id }}" {{ $manufacturer->id == $product->manufacturer_id ? 'selected' : '' }}>
                        {{ $manufacturer->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Cập nhật sản phẩm</button>
    </form>
@endsection
