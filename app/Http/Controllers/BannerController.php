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
        if (request()->ajax()) {
            $banner = Banner::latest()->get();
            return datatables()->of($banner)
                ->addColumn('action', function ($banner) {
                    return view('components.tableButton', [
                        'edit' => ["route" => "banner.edit", "id" => $banner->id],
                        'delete' => ["route" => "banner.destroy", "id" => $banner->id],
                    ]);
                })
                ->addColumn('image', function ($user) {
                    return '<img src="/images/' . $user->image . '" style="height:50px;width:100%">';
                })
                ->addColumn("checkbox", function ($row) {
                    return '<input type="checkbox" name="per_checkbox" data-id="' . $row->id . '"> <label></label>';
                })
                ->addColumn("created_at", function ($row) {
                    return $row->created_at =  $row->created_at->diffForHumans();
                })
                ->rawColumns(['action', 'checkbox', "image"])
                ->addIndexColumn()
                ->make(true);
        }
        return view('backend.banner.index');
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
        $request->validate([
            'image' => 'sometimes|mimes:png,jpg,jpeg,wep,gif',
            'title' => 'required',
            'description' => 'required',
            'status' => 'required',
        ]);
        $data =  new Banner();
        if (isset($request->image)) {
            $data->image = save_image($request->image);
        }
        $data->title = $request->title;
        $data->slug = Str::slug($request->title);
        $data->description = $request->description;
        $data->link = $request->link;
        $data->status = $request->status;
        notify()->success("Banners Created Successfully");
        $data-> save();
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
        return view('backend.banner.edit',compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'image' => 'sometimes',
            'title' => 'required',
            'description' => 'required',
            'status' => 'required',
        ]);
        DB::beginTransaction();
        try {
            $data = Banner::find($id);
            if (isset($request->image)) {
                $data->image = save_image($request->image);
            }
            $data->title = $request->title;
            $data->slug = Str::slug($request->title);
            $data->description = $request->description;
            $data->link = $request->link;
            $data->status = $request->status;
            $data->update();
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
        notify()->success("Banner Deleted Successfully");
        return redirect()->back();
    }

    
    public function deleteSelected(Request $request)
    {
        $ids = $request->ids;
        Banner::whereIn('id', $ids)->delete();
        return response()->json(["code" => 1, "msg" => "Banners have been deleted."]);
    }
}
