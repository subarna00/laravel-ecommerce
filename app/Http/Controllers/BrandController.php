<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = Brand::latest()->paginate(20);

        return view('backend.brand.index', compact("brands"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("backend.brand.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'image' => 'required|mimes:png,jpg,jpeg,wep,gif',
            'name' => 'required',
            'link' => 'sometimes',
            'status' => 'required',
        ]);
        if (isset($request->image)) {
            $data["image"] = save_image($request->image);
        }
        Brand::create($data);
        notify()->success("Brand Created Successfully");
        return redirect()->route('brands.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $brand = Brand::find($id);
        return view("backend.brand.edit", compact("brand"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'image' => 'sometimes|mimes:png,jpg,jpeg,wep,gif',
            'name' => 'required',
            'link' => 'sometimes',
            'status' => 'required',
        ]);
        try {
            $find = Brand::find($id);
            if (isset($request->image)) {
                $data["image"] = save_image($request->image);
                if ($data["image"]) {
                    delete_image("images/$find->image");
                }
            }
            $find->update($data);
            notify()->success("Brand Updated Successfully");
        } catch (\Throwable $th) {
            notify()->error($th->getMessage());
        }
        return redirect()->route('brands.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Brand::find($id);
        $data->delete();
        if ($data["image"]) {
            delete_image("images/$data->image");
        }
        notify()->success("Brand Deleted Successfully");
        return redirect()->back();
    }
    public function searchBrand(Request $request)
    {
        $data = $request->validate([
            "search" => "required|string"
        ]);
        $search = $data["search"];
        $brands = Brand::where("name", "LIKE", "%{$search}%")->latest()->paginate(20);
        return view("backend.brand.index", compact("brands"));
    }
}
