<?php

namespace App\Http\Controllers;

use App\Models\Minimarket;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index($id)
    {
        $minimarketAtt = Minimarket::find($id);
        $suppliers = Supplier::all();
        return view('supplier.home', compact('minimarketAtt', 'suppliers'));
    }

    public function store(Request $request, $id)
    {
        $validated = $request->validate([
            'suppliername' => 'required|string|min:1|max:100',
            'supplierdescription' => 'required|string|min:1',
            'supplierphonenum' => 'required|numeric|digits_between:1,14',
            'supplieraddress' => 'required|string|min:1|max:100',
            'supplierwebsite' => 'required|string|min:1|max:100',
        ]);

        $supplier = array(
            'minimarket_id' => $id,
            'supplier' => $validated['suppliername'],
            'description' => $validated['supplierdescription'],
            'phone_num' => $validated['supplierphonenum'],
            'address' => $validated['supplieraddress'],
            'website' => $validated['supplierwebsite']
        );

        Supplier::create($supplier);
        return redirect()->route('supplier', ['id' => $id])->with(['toast_primary' => 'Create facility successfully.']);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'suppliername' => 'required|string|min:1|max:100',
            'supplierdescription' => 'required|string|min:1|max:100',
            'supplierphonenum' => 'required|numeric|digits_between:1,14',
            'supplieraddress' => 'required|string|min:1|max:100',
            'supplierwebsite' => 'required|string|min:1|max:100',
        ]);

        $suppliers = Supplier::find($id);
        $suppliers->supplier = $validated['suppliername'];
        $suppliers->description = $validated['supplierdescription'];
        $suppliers->phone_num = $validated['supplierphonenum'];
        $suppliers->address = $validated['supplieraddress'];
        $suppliers->website = $validated['supplierwebsite'];

        $suppliers->save();
        return redirect()->route('supplier', ['id' => $suppliers->minimarket_id]);
    }

    public function delete($minimarketId, $supplierId)
    {
        $minimarket = Minimarket::find($minimarketId);
        $supplier = Supplier::find($supplierId);

        if ($supplier) {
            // Perform the delete operation
            $supplier->delete();
            // You can add any additional logic or redirect to a specific page after deletion
            return redirect()->back()->with('success', 'Supplier deleted successfully.');
        }

        // If the supplier is not found, you can handle the appropriate response
        return redirect()->back()->with('error', 'Supplier not found.');
    }
}
