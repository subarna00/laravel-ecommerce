<?php

namespace App\Http\Controllers;

use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subCategories = SubCategory::latest()->paginate(20);

        return view('backend.subcategory.index', compact("subCategories"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("backend.subcategory.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'image' => 'required|mimes:png,jpg,jpeg,wep,gif',
            'title' => 'required',
            'status' => 'required',
            'category_id' => "required|exists:categories,id"
        ]);
        if (isset($request->image)) {
            $data["image"] = save_image($request->image);
        }
        $data["slug"] = Str::slug($data["title"]);
        SubCategory::create($data);
        notify()->success("Category Created Successfully");
        return redirect()->route('sub-categories.index');
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
        $subCategory = SubCategory::find($id);
        return view("backend.subcategory.edit", compact("subCategory"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'image' => 'sometimes|mimes:png,jpg,jpeg,wep,gif',
            'title' => 'required',
            'status' => 'required',
            'category_id' => "required|exists:categories,id"

        ]);
        try {
            $find = SubCategory::find($id);
            if (isset($request->image)) {
                $data["image"] = save_image($request->image);
                if ($data["image"]) {
                    delete_image("images/$find->image");
                }
            }
            $data["slug"] = Str::slug($data["title"]);

            $find->update($data);
            notify()->success("Sub Category Updated Successfully");
        } catch (\Throwable $th) {
            notify()->error($th->getMessage());
        }
        return redirect()->route('sub-categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = SubCategory::find($id);
        $data->delete();
        if ($data["image"]) {
            delete_image("images/$data->image");
        }
        notify()->success("Sub Category Deleted Successfully");
        return redirect()->back();
    }
    public function searchSubCategories(Request $request)
    {
        $data = $request->validate([
            "search" => "required|string"
        ]);
        $search = $data["search"];
        $subCategories = SubCategory::where("title", "LIKE", "%{$search}%")->latest()->paginate(20);
        return view("backend.subcategory.index", compact("subCategories"));
    }
}
