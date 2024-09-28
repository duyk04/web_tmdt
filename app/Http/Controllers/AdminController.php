<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class AdminController extends Controller
{
    public function __construct()
    {
        // Đảm bảo chỉ có admin mới được truy cập vào các chức năng quản trị này
        $this->middleware('admin');
    }

    public function index()
    {
        return view('admin.dashboard');
    }

    // Hiển thị danh sách sản phẩm
    public function productsIndex()
    {
        // Lấy tất cả sản phẩm nếu là admin, còn người dùng chỉ xem được sản phẩm
        // $products = Product::all();
        // return view('admin.products.index', compact('products'));
        $productController = new ProductController();
        return $productController->adminProductsIndex();
    }

    // Hiển thị chi tiết một sản phẩm
    public function productsShow($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.products.show', compact('product'));
    }

    // Chỉ admin mới có quyền thêm sản phẩm
    public function productsCreate()
    {
        $productController = new ProductController();
        return $productController->adminProductsCreate();
    //     $categories = Category::all();
    //     return view('admin.products.create', compact('categories'));
    }

    public function productsStore(Request $request)
    {
        $productController = new ProductController();
        return $productController->adminProductsStore($request);
        // $data = $request->validate([
        //     'name' => 'required|string',
        //     'describe' => 'required|string',
        //     'quantity' => 'required|integer',
        //     'price' => 'required|numeric',
        //     'image' => 'required|image',
        //     'category_id' => 'required|integer|exists:categories,id',
        // ]);

        // $imagePath = $request->file('image')->store('product_images', 'public');
        // $data['image'] = $imagePath;

        // Product::create($data);

        // return redirect()->route('admin.products.index')->with('success', 'Sản phẩm đã được thêm');
    }

    // Chỉ admin mới có quyền sửa sản phẩm
    public function productsEdit($id)
    {
        $productController = new ProductController();
        return $productController->adminProductsEdit($id);
        // $product = Product::findOrFail($id);
        // $categories = Category::all();
        // return view('admin.products.edit', compact('product', 'categories'));
    }

    public function productsUpdate(Request $request, $id)
    {
        $productController = new ProductController();
        return $productController->adminProductsUpdate($request, $id);
        // $data = $request->validate([
        //     'name' => 'required|string',
        //     'describe' => 'required|string',
        //     'quantity' => 'required|integer',
        //     'price' => 'required|numeric',
        //     'image' => 'nullable|image',
        //     'category_id' => 'required|integer|exists:categories,id',
        // ]);

        // $product = Product::findOrFail($id);

        // if ($request->hasFile('image')) {
        //     $imagePath = $request->file('image')->store('product_images', 'public');
        //     $data['image'] = $imagePath;
        // }

        // $product->update($data);

        // return redirect()->route('admin.products.index')->with('success', 'Sản phẩm đã được cập nhật');
    }

    // Chỉ admin mới có quyền xóa sản phẩm
    public function productsDestroy($id) 
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Sản phẩm đã được xóa');
    }
}
