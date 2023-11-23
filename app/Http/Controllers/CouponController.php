<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCouponRequest;
use App\Http\Requests\UpdateCouponRequest;
use App\Models\Coupon;
use Illuminate\Support\Facades\Http;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $token = session('token');
        $response = Http::withHeaders([
            'Authorization' => 'Token ' . $token,
        ])->get(config('config.base_url').'dashboard/admin-coupons/');

        $data = json_decode($response);
        $coupons = $data->data;

        $category_response = Http::withHeaders([
            'Authorization' => 'Token ' . $token,
        ])->get(config('config.base_url').'categories/');

        $categories_data = json_decode($category_response);
        $categories = $categories_data->data;

        $coupons_response = Http::withHeaders([
            'Authorization' => 'Token ' . $token,
        ])->get(config('config.base_url').'dashboard/admin-coupons/');

        $coupons_data = json_decode($coupons_response);
        $coupons = $coupons_data->data;

        if($data->status == 200){
            return view('coupon.index',compact(['coupons','categories','coupons']));
        }else{
            return "Something went wrong";
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('coupon.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCouponRequest $request)
    {
        $token = session('token');
        $response = Http::withHeaders([
            'Authorization' => 'Token ' . $token,
        ])->post(config('config.base_url').'dashboard/admin-coupons/', [
            'name' => $request->input('name'),
            'item' => $request->input('item'),
            'description' => $request->input('description'),
            'quantity' => $request->input('quantity'),
            'coupon_quantity' => $request->input('coupon_quantity'),
            'category' => $request->input('category'),
            'size' => $request->input('size'),
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
            'start_time' => $request->input('start_time'),
            'end_time' => $request->input('end_time'),
            'logo' => $request->input('logo'),
            'notes' => $request->input('notes'),
            'org' => session('name') ?? null,
        ]);

        $data = json_decode($response);
        if($data->status == 200){
            return redirect()->route('employee.index')->with('message', 'Employee created successfully');
        }else{
            return "Something went wrong";
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Coupon $coupon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Coupon $coupon)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCouponRequest $request, Coupon $coupon)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Coupon $coupon)
    {
        //
    }
}
