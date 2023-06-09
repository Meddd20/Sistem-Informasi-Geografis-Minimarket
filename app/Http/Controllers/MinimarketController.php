<?php

namespace App\Http\Controllers;

use App\Models\Minimarket;
use App\Models\MinimarketFacility;
use App\Models\Product;
use App\Models\Picture;
use App\Models\Supplier;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MinimarketController extends Controller
{
        /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $minimarkets = Minimarket::all();
        return view('minimarket.home', compact('minimarkets'));
    }

    public function detail($id)
    {
        $minimarketFacilities = MinimarketFacility::all();
        $products = Product::all();
        $suppliers = Supplier::all();
        $pictures = Picture::all();
        $minimarketAtt = Minimarket::find($id);

        return view('minimarket.detail', compact('minimarketAtt', 'minimarketFacilities', 'products', 'suppliers', 'pictures'));
    }

    public function create()
    {
        return view('minimarket.create');
    }

    public function list()
    {
        $minimarketAtt = Minimarket::all();
        return view('minimarket.main', compact('minimarketAtt'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:1|max:100',
            'branch' => 'required|string|min:1|max:100',
            'company' => 'required|string|min:1|max:100',
            'address' => 'required|string|min:1|max:100',
            'contactnum' => 'required|numeric|digits_between:1,14',
            'website' => 'required|string|min:1|max:100',
            'email' => 'required|string|min:1|max:100',
            'customerservice' => 'required|numeric|digits_between:1,14',
            'operationalhour' => 'required|string|min:1|max:100',
            'description' => 'required|string|min:1|max:100',
            'latitude' => 'required',
            'longitude' => 'required',
            'pictures.0' => 'required|file|image|max:2048',
            'pictures.*' => 'nullable|file|image|max:2048'
        ]);

        $add_minimarket = array(
            'name' => $request->name,
            'branch' => $request->branch,
            'company' => $request->company,
            'address' => $request->address,
            'contact_num' => $request->contactnum,
            'website' => $request->website,
            'email' => $request->email,
            'customer_service_contact' => $request->customerservice,
            'operational_hour' => $request->operationalhour,
            'description' => $request->description,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude
        );

        DB::table('minimarkets')->insert($add_minimarket);

        $get_id_minimarket = Minimarket::orderBy('id', 'desc')->first();

        $filenames = [];
        for ($i = 0; $i < count($request['pictures']); $i++) {
            $image = $request->file('pictures')[$i];
            $filename = Str::slug($request['name']) . '-' . time() . $i . '.' . $image->getClientOriginalExtension();
            $path = public_path('/images/minimarkets');
            $image->move($path, $filename);
            array_push($filenames, $filename);
        }
        $images = [];
        $i = 0;
        foreach ($filenames as $filename) {
            if ($i == 0) {
                array_push($images, ['minimarket_id' => $get_id_minimarket->id, 'is_thumbnail' => 1, 'path' => $filename]);
            } else {
                array_push($images, ['minimarket_id' => $get_id_minimarket->id, 'is_thumbnail' => 0, 'path' => $filename]);
            }
            $i++;
        }

        Picture::insert($images);

        return redirect()->route('home');
    }

    public function edit($id)
    {
        $minimarketAtt = Minimarket::find($id);
        $pictures = Picture::all();
        return view('minimarket.edit', compact('minimarketAtt', 'pictures'));
    }

    public function update($id, Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|min:1|max:100',
            'branch' => 'required|string|min:1|max:100',
            'company' => 'required|string|min:1|max:100',
            'address' => 'required|string|min:1|max:100',
            'contactnum' => 'required|numeric|digits_between:1,14',
            'website' => 'required|string|min:1|max:100',
            'email' => 'required|string|min:1|max:100',
            'customerservice' => 'required|numeric|digits_between:1,14',
            'operationalhour' => 'required|string|min:1|max:100',
            'description' => 'required|string|min:1|max:100',
            'latitude' => 'required',
            'longitude' => 'required',
            'pictures.*' => 'nullable|file|image|max:2048'
        ]);

        $minimarketAtt = Minimarket::find($id);
        $minimarketAtt->name = $validated['name'];
        $minimarketAtt->branch = $validated['branch'];
        $minimarketAtt->company = $validated['company'];
        $minimarketAtt->contact_num = $validated['contactnum'];
        $minimarketAtt->website = $validated['website'];
        $minimarketAtt->email = $validated['email'];
        $minimarketAtt->customer_service_contact = $validated['customerservice'];
        $minimarketAtt->operational_hour = $validated['operationalhour'];
        $minimarketAtt->description = $validated['description'];
        $minimarketAtt->latitude = $validated['latitude'];
        $minimarketAtt->longitude = $validated['longitude'];

        if (!empty($validated['pictures'])) {
            $filenames = [];
        
            for ($i = 0; $i < count($request['pictures']); $i++) {
                $image = $request->file('pictures')[$i];
                $filename = Str::slug($request['name']) . '-' . time() . $i . '.' . $image->getClientOriginalExtension();
                $path = public_path('/images/minimarkets');
                $image->move($path, $filename);
                array_push($filenames, $filename);
            }
        
            $images = [];
            $isThumbnailSet = false; // Flag to track if the thumbnail is set
        
            foreach ($filenames as $filename) {
                $isThumbnail = !$isThumbnailSet; // Set is_thumbnail flag to true if it's the first image and no thumbnail is set
                array_push($images, [
                    'minimarket_id' => $minimarketAtt->id,
                    'is_thumbnail' => $isThumbnail,
                    'path' => $filename,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
        
                if ($isThumbnail) {
                    $isThumbnailSet = true; // Set the flag to true after the first image with is_thumbnail = true is inserted
                }
            }
        
            Picture::insert($images);
        }        

        $minimarketAtt->save();

        return redirect()->route('list');
    }

    public function removePicture($id)
    {
        $picture = Picture::find($id);
        
        if (!$picture) {
            abort(404); // or handle the error condition as per your application's logic
        }
        
        $filePath = public_path('images/minimarkets/' . $picture->path);
        
        if (file_exists($filePath)) {
            unlink($filePath);
        }
        
        $picture->delete();
        
        return back();
    }

    public function delete($id)
    {
        $minimarket = Minimarket::find($id);

        if ($minimarket) {
            // Delete the related entities
            $minimarket->facility()->delete();
            $minimarket->picture()->delete();
            $minimarket->product()->delete();
            $minimarket->supplier()->delete();

            // Delete the minimarket itself
            $minimarket->delete();

            return redirect()->back()->with('success', 'Minimarket and related entities deleted successfully.');
        }

        return redirect()->back()->with('error', 'Minimarket not found.');
    }

}
