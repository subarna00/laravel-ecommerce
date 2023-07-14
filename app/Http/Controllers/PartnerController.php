<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use Illuminate\Http\Request;

class PartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $partners = Partner::latest()->paginate(20);

        return view('backend.partners.index', compact("partners"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("backend.partners.create");
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
        Partner::create($data);
        notify()->success("Partner Created Successfully");
        return redirect()->route('partners.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $partner = Partner::find($id);
        return view("backend.partners.edit", compact("partner"));
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
            $find = Partner::find($id);
            if (isset($request->image)) {
                $data["image"] = save_image($request->image);
                if ($data["image"]) {
                    delete_image("images/$find->image");
                }
            }
            $find->update($data);
            notify()->success("Partner Updated Successfully");
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
        $data = Partner::find($id);
        $data->delete();
        if ($data["image"]) {
            delete_image("images/$data->image");
        }
        notify()->success("Partner Deleted Successfully");
        return redirect()->back();
    }
    public function searchPartner(Request $request)
    {
        $data = $request->validate([
            "search" => "required|string"
        ]);
        $search = $data["search"];
        $partners = Partner::where("name", "LIKE", "%{$search}%")->latest()->paginate(20);
        return view("backend.partners.index", compact("partners"));
    }
}
