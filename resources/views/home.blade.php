<!-- resources/views/home.blade.php -->

@extends('layouts.app')

@section('title', 'Trang chủ')

@section('content')
    <div class="jumbotron text-center">
        <h1>Chào mừng đến với My Laravel App</h1>
        <p>Đây là trang chủ của ứng dụng của bạn.</p>
        <a href="/categories" class="btn btn-primary">Xem danh sách Categories</a>
    </div>

    <div class="row mt-5">
        <div class="col-md-4">
            <h2>Giới thiệu</h2>
            <p>Thông tin giới thiệu về ứng dụng của bạn. Đây có thể là phần giới thiệu ngắn gọn về mục đích và chức năng chính của ứng dụng.</p>
        </div>
        <div class="col-md-4">
            <h2>Categories</h2>
            <p>Khám phá danh sách các categories trong hệ thống. Bạn có thể thêm, sửa và xóa các categories tại đây.</p>
        </div>
        <div class="col-md-4">
            <h2>Liên hệ</h2>
            <p>Nếu bạn cần hỗ trợ hoặc có bất kỳ câu hỏi nào, vui lòng liên hệ với chúng tôi qua phần liên hệ của trang.</p>
        </div>
    </div>
@endsection
