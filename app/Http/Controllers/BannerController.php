<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $banners = Banner::latest()->paginate(20);

        return view('backend.banner.index', compact("banners"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.banner.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'image' => 'required|mimes:png,jpg,jpeg,wep,gif',
            'title' => 'required',
            'description' => 'sometimes',
            'status' => 'required',
        ]);
        if (isset($request->image)) {
            $data["image"] = save_image($request->image);
        }
        $data["slug"] = Str::slug($data["title"]);
        Banner::create($data);
        notify()->success("Banners Created Successfully");
        return redirect()->route('banner.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Banner $banner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $banner = Banner::find($id);
        return view('backend.banner.edit', compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data =  $request->validate([
            'image' => 'sometimes',
            'title' => 'required',
            'description' => 'sometimes',
            'status' => 'required',
        ]);
        DB::beginTransaction();
        try {
            $find = Banner::find($id);
            if (isset($request->image)) {
                $data["image"] = save_image($request->image);
                if ($data["image"]) {
                    delete_image("images/$find->image");
                }
            }
            $data["slug"] = Str::slug($data["title"]);
            $find->update($data);
            DB::commit();
            notify()->success("Banner Updated Successfully");
        } catch (\Throwable $th) {
            DB::rollBack();
            notify()->error($th->getMessage());
        }
        return redirect()->route('banner.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Banner::find($id);
        $data->delete();
        if ($data["image"]) {
            delete_image("images/$data->image");
        }
        notify()->success("Banner Deleted Successfully");
        return redirect()->back();
    }


    public function deleteSelected(Request $request)
    {
        $ids = $request->ids;
        Banner::whereIn('id', $ids)->delete();
        return response()->json(["code" => 1, "msg" => "Banners have been deleted."]);
    }
    public function searchBanner(Request $request)
    {
        $data = $request->validate([
            "search" => "required|string"
        ]);
        $search = $data["search"];
        $banners = Banner::where("title", "LIKE", "%{$search}%")->latest()->paginate(20);

        return view("backend.banner.index", compact("banners"));
    }
}
