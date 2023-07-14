<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use Illuminate\Http\Request;

class AdController extends Controller
{
    public function index()
    {
        $ads = Ad::latest()->paginate(20);

        return view('backend.ads.index', compact("ads"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("backend.ads.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'image' => 'required|mimes:png,jpg,jpeg,wep,gif',
            'title' => 'required',
            'link' => 'sometimes',
            'status' => 'required',
        ]);
        if (isset($request->image)) {
            $data["image"] = save_image($request->image);
        }
        Ad::create($data);
        notify()->success("Ads Created Successfully");
        return redirect()->route('ads.index');
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
        $ad = Ad::find($id);
        return view("backend.ads.edit", compact("ad"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'image' => 'sometimes|mimes:png,jpg,jpeg,wep,gif',
            'title' => 'required',
            'link' => 'sometimes',
            'status' => 'required',
        ]);
        try {
            $find = Ad::find($id);
            if (isset($request->image)) {
                $data["image"] = save_image($request->image);
                if ($data["image"]) {
                    delete_image("images/$find->image");
                }
            }
            $find->update($data);
            notify()->success("Ads Updated Successfully");
        } catch (\Throwable $th) {
            notify()->error($th->getMessage());
        }
        return redirect()->route('ads.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Ad::find($id);
        $data->delete();
        if ($data["image"]) {
            delete_image("images/$data->image");
        }
        notify()->success("Ads Deleted Successfully");
        return redirect()->back();
    }
    public function searchAds(Request $request)
    {
        $data = $request->validate([
            "search" => "required|string"
        ]);
        $search = $data["search"];
        $ads = Ad::where("title", "LIKE", "%{$search}%")->latest()->paginate(20);
        return view("backend.ads.index", compact("ads"));
    }
}
