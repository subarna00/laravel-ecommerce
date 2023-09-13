<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::where("type", "admin")->orWhere("type", "sub_admin")->latest()->paginate(20);
        return view("backend.user.index", compact("users"));
    }
    public function create()
    {
        return view("backend.user.create");
    }
    public function store(Request $request)
    {
        if (auth()->user()->type == "admin") {
            $data = $request->validate([
                "name" => "required",
                "email" => "required|email|unique:users,email",
                "password" => "required",
                "confirm_password" => "required|same:password",
                "address" => "required",
                "phone_number" => "required",
                "image" => "sometimes",
                "type" => "required",
            ]);
            $data["password"] = bcrypt($data["password"]);
            if (isset($data["image"])) {
                $data["image"] = save_image($data["image"]);
            }
            User::create($data);
            notify()->success("User created");
            return redirect()->route("userPage");
        }
        return abort(403);
    }
    public function edit($id)
    {
        if (auth()->user()->type == "admin") {

            $user = User::find($id);
            return view("backend.user.edit", compact("user"));
            return abort(403);
        }
    }
    public function update(Request $request, $id)
    {
        if (auth()->user()->type == "admin") {

            $user = User::find($id);
            if ($user) {
                $data = $request->validate([
                    "name" => "required",
                    "email" => "required|email|unique:users,email," . $user->id,
                    "password" => "sometimes",
                    "confirm_password" => "sometimes|same:password",
                    "address" => "required",
                    "phone_number" => "required",
                    "image" => "sometimes",
                    "type" => "required",
                ]);
                if ($request->password) {
                    $user->password = bcrypt($data["password"]);
                }
                if ($request->hasFile("image")) {
                    $user->image = save_image($request->image);
                }
                $user->name = $request->name ?? $user->name;
                $user->type = $request->type ?? $user->type;
                $user->email = $request->email ?? $user->email;
                $user->address = $request->address ?? $user->address;
                $user->phone_number = $request->phone_number ?? $user->phone_number;
                $user->password = $data["password"] ? bcrypt($data["password"]) : $user->password;
                $user->update();
                notify()->success("User updated");
                return redirect()->route("userPage");
            }
            notify()->warning("User does not exist");
            return redirect()->back();
        }
        return abort(403);
    }
    public function destroy($id)
    {
        if (auth()->user()->type == "admin") {

            $data = User::find($id);
            $data->delete();
            if ($data["image"]) {
                delete_image("images/$data->image");
            }
            notify()->success("User Deleted Successfully");
            return redirect()->back();
        }
        return abort(403);
    }
}
