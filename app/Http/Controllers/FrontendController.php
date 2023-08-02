<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Cart;
use App\Models\Category;
use App\Models\ContactForm;
use App\Models\Order;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FrontendController extends Controller
{
    public function shop()
    {
        $data["products"] = Product::where("status", "active")->latest()->inRandomOrder()->paginate(9);
        return view("frontend.pages.shop", $data);
    }
    public function searchProduct(Request $request)
    {
        $data = $request->validate([
            "search" => "required|string"
        ]);
        $search = $data["search"];
        $products = Product::where("name", "LIKE", "%{$search}%")->latest()->paginate(20);
        return view("frontend.pages.shop", compact("products"));
    }
    public function productCategory($slug)
    {
        $data["category"] = Category::where("slug", $slug)->first();
        $data["title"] = $data["category"]->title;

        $data["products"] = Product::where("category_id", $data["category"]->id)->latest()->inRandomOrder()->paginate(9);
        return view("frontend.pages.shop", $data);
    }
    public function productSubCategory($slug)
    {
        $data["category"] = SubCategory::where("slug", $slug)->first();
        $data["title"] = $data["category"]->title;

        $data["products"] = Product::where("sub_category_id", $data["category"]->id)->latest()->inRandomOrder()->paginate(9);
        return view("frontend.pages.shop", $data);
    }
    public function productBrand($slug)
    {
        $data["category"] = Brand::where("id", $slug)->first();
        $data["title"] = $data["category"]->name;

        $data["products"] = Product::where("brand_id", $data["category"]->id)->latest()->inRandomOrder()->paginate(9);
        return view("frontend.pages.shop", $data);
    }
    public function productDetail($slug)
    {
        $product = Product::where("slug", $slug)->first();
        $products = Product::where("category_id", $product->category_id)->latest()->take(8)->inRandomOrder()->get();
        return view("frontend.pages.productDetail", compact("product", "products"));
    }

    public function loginPage()
    {
        return view("frontend.pages.login");
    }
    public function registerPage()
    {
        return view("frontend.pages.register");
    }
    public function userRegistration(Request $request)
    {
        $data = $request->validate([
            "name" => "required",
            "email" => "required|email|unique:users,email",
            "password" => "required",
            "confirm_password" => "required|same:password",
            "address" => "required",
            "phone_number" => "required"
        ]);
        $data["type"] = "user";
        $data["password"] = bcrypt($data["password"]);
        User::create($data);
        return redirect()->route("loginPage")->with("msg", "Account is created. Login in to access your profile.");
    }
    public function userLogin(Request $request)
    {
        $data = $request->validate([
            "email" => "required|email",
            "password" => "required",
        ]);
        if (Auth::attempt($data)) {
            $user = User::where("email", $request->email)->first();
            Auth::login($user);
            return redirect()->route("userDashboard");
        }
        return redirect()->back()->with("loginMsg", "Credential doesn't match. Try Again.");
    }
    public function userDashboard()
    {
        if (Auth::user()) {
            $orders = Order::where("user_id", auth()->user()->id)->latest()->paginate(20);
            return view("frontend.pages.user_dashboard", compact("orders"));
        }
        return abort(403, "Something went wrong");
    }

    public function updateProfile(Request $request)
    {
        if (auth()->user()) {
            $data = $request->validate([
                "name" => "sometimes",
                "email" => "sometimes",
                "password" => "sometimes",
                "confirm_password" => "sometimes|same:password",
                "address" => "sometimes",
                "phone_number" => "sometimes",
                "image" => "sometimes"
            ]);
            if (isset($data["image"])) {
                $data["image"] = save_image($data["image"]);
            }
            $user = User::find(auth()->user()->id);
            $user->name = $request->name ?? $user->name;
            $user->email = $request->email ?? $user->email;
            $user->address = $request->address ?? $user->address;
            $user->phone_number = $request->phone_number ?? $user->phone_number;
            $user->image = $data["image"] ?? $user->image;
            $user->password = $data["password"] ? bcrypt($data["password"]) : $user->password;
            $user->update();
            return redirect()->route("userDashboard")->with("tab", "profile")->with("userUpdate", "Profile is updated");
        }
        return abort(403, "Something went wrong");
    }
    public function addToCart(Request $request)
    {
        $data = $request->validate([
            "product_id" => "required",
            "quantity" => "required"
        ]);
        $caart = Cart::where(["product_id" => $data["product_id"], "user_id" => auth()->user()->id])->first();
        if (!$caart) {
            $data["user_id"] = auth()->user()->id;
            Cart::create($data);
        }

        return redirect()->back()->with("cart", "Added in cart");
    }
    public function deleteFromCart($id)
    {
        $cart = Cart::find($id);
        if ($cart) {
            $cart->delete();
            return redirect()->back();
        }
        return redirect()->back();
    }
    public function updateCart(Request $request, $id)
    {
        $cart = Cart::find($id);
        if ($request->quantity <= 0) {
            $cart->delete();
            return;
        }
        if ($cart) {
            $cart->quantity = $request->quantity;
            $cart->update();
            return true;
        }
        return;
    }
    public function cartPage()
    {
        return view("frontend.pages.cart");
    }

    public function checkoutPage()
    {
        return view("frontend.pages.checkout");
    }
    public function addOrder(Request $request)
    {
        $data = $request->validate([
            "bname" => "required|string",
            "baddress" => "required|string",
            "bemail" => "required|string",
            "bnumber" => "required|string|numeric",
            "note" => "required|string",
            "receipt" => "required|mimes:png,jpg,jpeg,wep,gif",
        ]);
        DB::beginTransaction();
        try {
            $user = auth()->user();
            $cartItems = Cart::where("user_id", $user->id)->get();
            if (count($cartItems) > 0) {
                foreach ($cartItems as $key => $cart) {
                    $price = $cart->product->price;
                    if ($cart->product->offer) {
                        $price = getDiscountPrice($cart->product->price, $cart->product->offer);
                    } else if ($cart->product->discount) {
                        $price = getDiscountPrice($cart->product->price, $cart->product->discount);
                    }
                    Order::create([
                        "user_id" => $user->id,
                        "product_id" => $cart->product_id,
                        "bname" => $data["bname"],
                        "baddress" => $data["baddress"],
                        "bemail" => $data["bemail"],
                        "bnumber" => $data["bnumber"],
                        "note" => $data["note"],
                        "price" =>  $price,
                        "quantity" => $cart->quantity,
                        "total" => $price * $cart->quantity,
                        "status" => "Placed",
                        "receipt" =>  save_image($data["receipt"], "receipts"),
                    ]);
                    $cart->delete();
                }
            }
            DB::commit();
            return redirect()->route("userDashboard")->with("order", "Your order is placed. We will reach you soon. Thank you!");
        } catch (\Throwable $th) {
            DB::rollBack();
            echo $th->getMessage();
            dd($th->getMessage());
            //throw $th;
        }
    }
    public function updateOrder(Request $request)
    {
        $data = $request->validate([
            "order_id" => "required",
            "status" => "required"
        ]);
        $order = Order::find($data["order_id"]);
        if (auth()->user()->id == $order->id) {
            $order->status = $data["status"];
            $order->update();
            return redirect()->back()->with("order", "Your order is canceled.");
        }
        return abort(403);
    }
    public function contactUs()
    {
        return view("frontend.pages.contact");
    }
    public function storeContact(Request $request)
    {
        $data =  $request->validate([
            "name" => "required|string",
            "email" => "required|email",
            "number" => "required|digits:10",
            "message" => "required|string",
        ]);
        ContactForm::create($data);
        return redirect()->back()->with("msg", "Thank you for messaging us. We will reach you soon.");
    }
}
