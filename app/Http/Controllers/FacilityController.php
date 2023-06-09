<?php

namespace App\Http\Controllers;

use App\Models\Minimarket;
use App\Models\MinimarketFacility;
use Illuminate\Http\Request;

class FacilityController extends Controller
{
    public function index($id) 
    {
        $facilities = MinimarketFacility::all();
        $minimarketAtt = Minimarket::find($id);
        return view('facility.home', compact('facilities', 'minimarketAtt'));
    }

    public function store(Request $request, $id)
    {
        $validated = $request->validate([
            'facilityname' => 'required|string|min:1|max:100',
            'facilitydescription' => 'required|string|min:1|max:100'
        ]);

        $facility = array(
            'minimarket_id' => $id,
            'facility_type' => $validated['facilityname'],
            'description' => $validated['facilitydescription']
        );

        MinimarketFacility::create($facility);
        return redirect()->route('facility', ['id' => $id])->with(['toast_primary' => 'Create facility successfully.']);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'facilityname' => 'required|string|min:1|max:100',
            'facilitydescription' => 'required|string|min:1|max:100',
        ]);

        $facilities = MinimarketFacility::find($id);
        $facilities->facility_type = $validated['facilityname'];
        $facilities->description = $validated['facilitydescription'];

        $facilities->save();
        return redirect()->route('facility', ['id' => $facilities->minimarket_id]);
    }

    public function delete($id, $facilityId)
    {
        $minimarket = Minimarket::find($id);
        $facilities = MinimarketFacility::find($facilityId);

        if ($facilities) {
            // Perform the delete operation
            $facilities->delete();
            // You can add any additional logic or redirect to a specific page after deletion
            return redirect()->back()->with('success', 'Facility deleted successfully.');
        }

        // If the supplier is not found, you can handle the appropriate response
        return redirect()->back()->with('error', 'Facility not found.');
    }
}
