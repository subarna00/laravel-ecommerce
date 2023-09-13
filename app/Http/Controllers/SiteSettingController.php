<?php

namespace App\Http\Controllers;

use App\Models\SiteSetting;
use Illuminate\Http\Request;

class SiteSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $siteSetting = SiteSetting::first();
        return view("backend.siteSetting.create", compact("siteSetting"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $siteSetting = SiteSetting::find(1);
        return view("backend.siteSetting.create", compact("siteSetting"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data =  $request->validate([
            "name" => "sometimes",
            "logo" => "sometimes",
            "qr" => "sometimes",
            "digital_s" => "sometimes",
            "favicon" => "sometimes",
            "email" => "sometimes|email",
            "number" => "sometimes|string",
            "address" => "sometimes|string",
            "map" => "sometimes",
            "facebook" => "sometimes",
            "instagram" => "sometimes",
            "youtube" => "sometimes",
            "tiktok" => "sometimes",
            "bill_text" => "sometimes",

        ]);
        $setting = SiteSetting::find($id);
        $setting->name = $request->name;
        if ($request->hasFile("logo")) {
            $setting->logo = save_image($request->logo);
        }
        if ($request->hasFile("favicon")) {
            $setting->favicon = save_image($request->favicon);
        }
        if ($request->hasFile("digital_s")) {
            $setting->digital_s = save_image($request->digital_s);
        }
        if ($request->hasFile("qr")) {
            $setting->qr = save_image($request->qr);
        }
        $setting->email = $request->email;
        $setting->bill_text = $request->bill_text;
        $setting->address = $request->address;
        $setting->number = $request->number;
        $setting->map = $request->map;
        $setting->facebook = $request->facebook;
        $setting->tiktok = $request->tiktok;
        $setting->instagram = $request->instagram;
        $setting->youtube = $request->youtube;
        $setting->update();
        notify()->success("Site is updated");
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        //
    }
}
