<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Manufacturer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function adminProductsIndex()
    {
        // Lấy tất cả sản phẩm cho admin
        $products = Product::all();
        return view('admin.products.index', compact('products'));
    }

    public function adminProductsCreate()
    {
        $manufacturers = Manufacturer::all();
        return view('admin.products.create', compact('manufacturers'));
    }
    public function adminProductsStore(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'describe' => 'required|string',
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
            'image' => 'required|image',
            'manufacturer_id' => 'required|integer|exists:manufacturers,id',
        ]);

        // Lưu ảnh
        $imagePath = $request->file('image')->store('product_images', 'public');
        $data['image'] = $imagePath;

        Product::create($data);

        return redirect()->route('admin.products.index')->with('success', 'Sản phẩm đã được thêm');
    }

    public function adminProductsEdit($id)
    {

        if (Auth::user()->role !== 'admin') {
            return redirect()->route('customer.products.index')->with('error', 'Bạn không có quyền sửa sản phẩm.');
        }
        // Tìm đối tượng Product dựa trên id
        $product = Product::findOrFail($id);
        $manufacturers = Manufacturer::all();
        return view('admin.products.edit', compact('product', 'manufacturers'));
    }

    public function adminProductsUpdate(Request $request, $id)
    {
        // Tìm đối tượng Product dựa trên id
        $product = Product::findOrFail($id);
        $data = $request->validate([
            'name' => 'required|string',
            'describe' => 'required|string',
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
            'image' => 'nullable|image',
            'manufacturer_id' => 'required|integer|exists:manufacturers,id',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('product_images', 'public');
            $data['image'] = $imagePath;
        }

        $product->update($data);

        return redirect()->route('admin.products.index')->with('success', 'Sản phẩm đã được cập nhật');
    }


    public function index()
    {

        $products = Product::with('manufacturer')->get();
        return view('customer.products.index', compact('products'));
    }

    public function create()
    {
        $manufacturers = Manufacturer::all();
        return view('products.create', compact('manufacturers'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'describe' => 'required|string',
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
            'image' => 'required|image',
            'manufacturer_id' => 'required|integer|exists:manufacturers,id',
        ]);

        // Lưu ảnh
        $imagePath = $request->file('image')->store('product_images', 'public');
        $data['image'] = $imagePath;

        Product::create($data);

        return redirect()->route('products.index')->with('success', 'Sản phẩm đã được thêm');
    }

    public function edit(Product $product)
    {
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('customer.products.index')->with('error', 'Bạn không có quyền sửa sản phẩm.');
        }
        $manufacturers = Manufacturer::all();
        return view('products.edit', compact('product', 'manufacturers'));
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'describe' => 'required|string',
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
            'image' => 'nullable|image',
            'manufacturer_id' => 'required|integer|exists:manufacturers,id',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('product_images', 'public');
            $data['image'] = $imagePath;
        }

        $product->update($data);

        return redirect()->route('products.index')->with('success', 'Sản phẩm đã được cập nhật');
    }

    public function destroy(Product $product)
    {
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('customer.products.index')->with('error', 'Bạn không có quyền xóa sản phẩm.');
        }

        $product->delete();
        return redirect()->route('products.index')->with('success', 'Sản phẩm đã được xóa');
    }
}
