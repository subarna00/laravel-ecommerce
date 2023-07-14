<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::latest()->paginate(20);

        return view('backend.category.index', compact("categories"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("backend.category.create");
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
        ]);
        if (isset($request->image)) {
            $data["image"] = save_image($request->image);
        }
        $data["slug"] = Str::slug($data["title"]);
        Category::create($data);
        notify()->success("Category Created Successfully");
        return redirect()->route('categories.index');
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
        $category = Category::find($id);
        return view("backend.category.edit", compact("category"));
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
        ]);
        try {
            $find = Category::find($id);
            if (isset($request->image)) {
                $data["image"] = save_image($request->image);
                if ($data["image"]) {
                    delete_image("images/$find->image");
                }
            }
            $data["slug"] = Str::slug($data["title"]);

            $find->update($data);
            notify()->success("Category Updated Successfully");
        } catch (\Throwable $th) {
            notify()->error($th->getMessage());
        }
        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Category::find($id);
        $data->delete();
        if ($data["image"]) {
            delete_image("images/$data->image");
        }
        notify()->success("Category Deleted Successfully");
        return redirect()->back();
    }
    public function searchCategory(Request $request)
    {
        $data = $request->validate([
            "search" => "required|string"
        ]);
        $search = $data["search"];
        $categories = Category::where("title", "LIKE", "%{$search}%")->latest()->paginate(20);
        return view("backend.category.index", compact("categories"));
    }
}
