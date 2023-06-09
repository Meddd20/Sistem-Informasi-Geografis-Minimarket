<?php

namespace App\Http\Controllers;

use App\Models\Minimarket;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index($id)
    {
        $minimarketAtt = Minimarket::find($id);
        $products = Product::all();
        $productcategories = ProductCategory::all();
        return view('product.home', compact('minimarketAtt', 'products', 'productcategories'));
    }

    public function create($id)
    {
        $minimarketAtt = Minimarket::find($id);
        $productcategories = ProductCategory::all();
        return view('product.create', compact('minimarketAtt', 'productcategories'));
    }

    public function store(Request $request, $id)
    {
        $validated = $request->validate([
            'productname' => 'required|string|min:1|max:100',
            'productdescription' => 'required|string|min:1|max:255',
            'productprice' => 'required|string|min:1',
            'pictures' => 'required|file|image|max:2048',
            'productcategory' => 'required|exists:product_categories,id',
        ]);
    
        $product = array(
            'minimarket_id' => $id,
            'productcategory_id' => $validated['productcategory'],
            'product_name' => $validated['productname'],
            'description' => $validated['productdescription'],
            'price' => $validated['productprice'],
        );

        // Handle picture upload
        if ($request->hasFile('pictures')) {
            $pictures = $request->file('pictures');
            $picturePath = $pictures->store('products', 'public');
            $product['product_image'] = $picturePath;
        }

        DB::table('products')->insert($product);
        return redirect()->route('product', ['id' => $id]);
    }

    public function edit($minimarketId, $productId)
    {
        $minimarketAtt = Minimarket::find($minimarketId);
        $products = Product::find($productId);
        $productcategories = ProductCategory::all();
        return view('product.edit', compact('minimarketAtt', 'products', 'productcategories'));
    }

    public function update(Request $request, $minimarketId, $productId)
    {
        $validated = $request->validate([
            'productname' => 'required|string|min:1|max:100',
            'productdescription' => 'required|string|min:1|max:255',
            'productprice' => 'required|string|min:1',
            'pictures' => 'nullable|image|max:2048',
            'productcategory' => 'required|exists:product_categories,id',
        ]);

        $product = Product::find($productId);
        $product->product_name = $validated['productname'];
        $product->description = $validated['productdescription'];
        $product->price = $validated['productprice'];
        $product->productcategory_id = $validated['productcategory'];

        // Handle picture upload
        if ($request->hasFile('pictures')) {
            $picture = $request->file('pictures');
            $picturePath = $picture->store('products', 'public');
            $product->product_image = $picturePath;
        }

        $product->save();
        return redirect()->route('product', ['id' => $minimarketId]);
    }

    public function delete($minimarketId, $productId)
    {
        // Retrieve the minimarket and product based on their IDs
        $minimarket = Minimarket::find($minimarketId);
        $product = Product::find($productId);

        if ($product) {
            // Perform the delete operation
            $product->delete();
            // You can add any additional logic or redirect to a specific page after deletion
            return redirect()->back()->with('success', 'Product deleted successfully.');
        }

        // If the product is not found, you can handle the appropriate response
        return redirect()->back()->with('error', 'Product not found.');
    }
}
