<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function __construct()
    {
        // Đảm bảo chỉ có admin mới được truy cập vào các chức năng quản trị này
        $this->middleware('customer');
    }

    public function index()
    {
        return view('customer.dashboard');
    }
}
