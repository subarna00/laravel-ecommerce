<?php

namespace App\Http\Controllers;

use App\Models\ContactForm;
use App\Models\Order;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

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
    public function updateOrder(Request $request)
    {
        $data = $request->validate([
            "order_id" => "required",
            "status" => "required"
        ]);
        $order = Order::find($data["order_id"]);
        if (auth()->user()->type == "admin") {
            $order->status = $data["status"];
            $order->update();
            return redirect()->back()->with("order", "Your order is canceled.");
        }
        return abort(403);
    }
    public function downloadBill($id)
    {
        try {
            $data["orders"] = Order::find($id);
            $pdf = Pdf::loadView('backend.pdf.bill.OrderBill', $data);
            return $pdf->download('orderBill.pdf');
        } catch (\Throwable $th) {
           return $th->getMessage();
        }

    }
}
