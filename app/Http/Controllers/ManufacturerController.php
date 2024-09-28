<?php

namespace App\Http\Controllers;

use App\Models\Manufacturer;
use Illuminate\Http\Request;

class ManufacturerController extends Controller
{
    public function index()
    {
        // Hiển thị danh sách tất cả manufacturers
        $manufacturers = Manufacturer::all();
        return view('manufacturers.index', compact('manufacturers'));
    }

    public function create()
    {
        // Hiển thị form thêm mới manufacturer
        return view('manufacturers.create');
    }

    public function store(Request $request)
    {
        // Lưu dữ liệu từ form thêm mới vào CSDL
        $request->validate([
            'name' => 'required'
        ]);

        Manufacturer::create($request->all());
        return redirect()->route('manufacturers.index')
                         ->with('success', 'Manufacturer created successfully.');
    }

    public function edit(Manufacturer $manufacturer)
    {
        // Hiển thị form chỉnh sửa manufacturer
        return view('manufacturers.edit', compact('manufacturer'));
    }

    public function update(Request $request, Manufacturer $manufacturer)
    {
        // Cập nhật dữ liệu manufacturer
        $request->validate([
            'name' => 'required'
        ]);

        $manufacturer->update($request->all());
        return redirect()->route('manufacturers.index')
                         ->with('success', 'Manufacturer updated successfully.');
    }

    public function destroy(Manufacturer $manufacturer)
    {
        // Xóa manufacturer
        $manufacturer->delete();
        return redirect()->route('manufacturers.index')
                         ->with('success', 'Manufacturer deleted successfully.');
    }
}
