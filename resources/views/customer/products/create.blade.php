@extends('layouts.app')
@section('title', 'Quản lý sản phầm - Tạo mới')
@section('content')
    <h1>Thêm sản phẩm mới</h1>

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Tên sản phẩm</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>

        <div class="form-group">
            <label for="describe">Mô tả sản phẩm</label>
            <textarea class="form-control" id="describe" name="describe" required></textarea>
        </div>

        <div class="form-group">
            <label for="quantity">Số lượng</label>
            <input type="number" class="form-control" id="quantity" name="quantity" required>
        </div>

        <div class="form-group">
            <label for="price">Giá</label>
            <input type="text" class="form-control" id="price" name="price" required>
        </div>

        <div class="form-group">
            <label for="image">Ảnh sản phẩm</label>
            <input type="file" class="form-control" id="image" name="image" required>
        </div>

        <div class="form-group">
            <label for="manufacturer_id">Hãng sản xuất</label>
            <select class="form-control" id="manufacturer_id" name="manufacturer_id" required>
                <option value="">Chọn hãng sản xuất</option>
                @foreach ($manufacturers as $manufacturer)
                    <option value="{{ $manufacturer->id }}">{{ $manufacturer->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Thêm sản phẩm</button>
    </form>
@endsection
