<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    public function store(Request $request, $minimarketId, $productId = null)
    {
        $validated = $request->validate([
            'productcategory' => 'required|string|min:1|max:100',
        ]);

        $productcategory = array(
            'product_category' => $validated['productcategory']
        );

        ProductCategory::create($productcategory);
        
        if ($productId) {
            // Redirect to the product edit page
            return redirect()->route('product-edit', ['minimarketId' => $minimarketId, 'productId' => $productId]);
        } else {
            // Redirect back to the product create page
            return back();
        }
    }

}
