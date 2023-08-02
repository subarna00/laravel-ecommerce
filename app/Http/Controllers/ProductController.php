<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Models\Dimension;
use App\Models\Image;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::latest()->paginate(20);
        return view("backend.product.index", compact("products"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("backend.product.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            "model" => "sometimes|string",
            "name" => "required|string",
            "stock" => "required",
            "brand_id" => "required|exists:brands,id",
            "sub_category_id" => "required|exists:sub_categories,id",
            "category_id" => "required|exists:categories,id",
            "description" => "sometimes",
            "sub_description" => "sometimes",
            "price" => "required",
            "discount" => "sometimes",
            "offer" => "sometimes",
            "rating" => "required",
            "types" => "required",
            "status" => "required",
            "sizes" => "required",
            "savailable" => "required",
            "colors" => "required",
            "cavailable" => "required",
            "dimension" => "required",
            "policy" => "required",
            "images" => "required"
        ]);
        DB::beginTransaction();
        try {
            //product
            $data["slug"] = Str::slug($data["name"]);
            $product = Product::create($data);
            // sizes
            if (isset($data["sizes"])) {
                foreach ($data["sizes"] as $key => $size) {
                    Size::create([
                        "size" => $size,
                        "available" => $data["savailable"][$key] ?? "Not Available",
                        "product_id" => $product->id
                    ]);
                }
            }
            // images
            if (isset($data["images"])) {
                foreach ($data["images"] as $key => $image) {
                    Image::create([
                        "image" => save_image($image),
                        "product_id" => $product->id
                    ]);
                }
            }
            // colors
            if (isset($data["colors"])) {
                foreach ($data["colors"] as $key => $color) {
                    Color::create([
                        "color" => $color,
                        "available" => $data["cavailable"][$key] ?? "Not Available",
                        "product_id" => $product->id

                    ]);
                }
            }
            // Dimension
            if (isset($data["dimension"])) {
                Dimension::create([
                    "dimension" => $data["dimension"],
                    "available" => $data["cavailable"][$key] ?? "Not Available",
                    "product_id" => $product->id
                ]);
            }
            DB::commit();
            notify()->success("Product is created");
            return redirect()->route("products.index");
        } catch (\Throwable $th) {
            DB::rollBack();
            notify()->error($th->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $product = Product::find($id);
        return view("backend.product.edit", compact("product"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            "model" => "sometimes|string",
            "name" => "required|string",
            "stock" => "required",
            "brand_id" => "required|exists:brands,id",
            "sub_category_id" => "required|exists:sub_categories,id",
            "category_id" => "required|exists:categories,id",
            "description" => "sometimes",
            "sub_description" => "sometimes",
            "price" => "required",
            "discount" => "sometimes",
            "offer" => "sometimes",
            "rating" => "required",
            "types" => "required",
            "status" => "required",
            "sizes" => "sometimes",
            "savailable" => "sometimes",
            "colors" => "sometimes",
            "cavailable" => "sometimes",
            "dimension" => "required",
            "policy" => "required",
            "images" => "sometimes"
        ]);

        DB::beginTransaction();
        try {
            //product
            $data["slug"] = Str::slug($data["name"]);
            $product = Product::find($id);
            $product->update($data);
            // sizes
            if (isset($data["sizes"])) {
                foreach ($data["sizes"] as $key => $size) {
                    Size::create([
                        "size" => $size,
                        "available" => $data["savailable"][$key] ?? "Not Available",
                        "product_id" => $product->id
                    ]);
                }
            }
            // images
            if (isset($data["images"])) {
                foreach ($data["images"] as $key => $image) {
                    Image::create([
                        "image" => save_image($image),
                        "product_id" => $product->id
                    ]);
                }
            }
            // colors
            if (isset($data["colors"])) {
                foreach ($data["colors"] as $key => $color) {
                    Color::create([
                        "color" => $color,
                        "available" => $data["cavailable"][$key] ?? "Not Available",
                        "product_id" => $product->id

                    ]);
                }
            }
            // Dimension
            if (isset($data["dimension"])) {
                if ($product->dimension) {
                    Dimension::find($product->dimension->id)->update([
                        "dimension" => $data["dimension"],
                        "available" =>  "Not Available",
                        "product_id" => $product->id
                    ]);
                } else {
                    Dimension::create([
                        "dimension" => $data["dimension"],
                        "available" =>  "Not Available",
                        "product_id" => $product->id
                    ]);
                }
            }
            DB::commit();
            notify()->success("Product is updated");
            return redirect()->route("products.index");
        } catch (\Throwable $th) {
            DB::rollBack();
            notify()->error($th->getMessage());
            return redirect()->back();
            //throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            Product::find($id)->delete();
            DB::commit();
            notify()->warning("Product is deleted");
            return redirect()->back();
        } catch (\Throwable $th) {
            DB::rollBack();
            notify()->error($th->getMessage());
        }
    }
    public function searchProducts(Request $request)
    {
        $data = $request->validate([
            "search" => "required|string"
        ]);
        $search = $data["search"];
        $products = Product::where("name", "LIKE", "%{$search}%")->latest()->paginate(20);
        return view("backend.product.index", compact("products"));
    }
    public function deleteImage($id)
    {
        try {
            $img = Image::find($id)->delete();
            if ($img) {
                delete_image("images", $img->image);
            }
            return true;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
    public function deleteSize($id)
    {
        try {
            Size::find($id)->delete();
            return true;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
    public function deleteColor($id)
    {
        try {
            Color::find($id)->delete();
            return true;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}
