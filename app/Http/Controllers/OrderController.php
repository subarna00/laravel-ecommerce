<?php

namespace App\Http\Controllers;

use App\Models\ContactForm;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::latest()->paginate(20);
        return view("backend.orders.order", ["orders" => $orders]);
    }
    public function contact()
    {
        $contacts = ContactForm::latest()->paginate(30);
        return view("backend.contactForm.contact", compact("contacts"));
    }
    public function filterOrder(Request $request)
    {
        $data = $request->validate([
            "search" => "sometimes|string",
            // "from" => "sometimes",
            // "to" => "sometimes"
        ]);
        $search = $data["search"];
        $orders = Order::where("bname", "LIKE", "%{$search}%")
            // ->when($data["from"] && $data["to"], function ($q, $data) {
            //     return $q->whereBetween($data["from"], $data["to"]);
            // })

            ->latest()->paginate(20);
        return view("backend.orders.order", compact("orders"));
    }
}
