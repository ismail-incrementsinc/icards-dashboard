<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePackagePricingRequest;
use App\Http\Requests\UpdatePackagePricingRequest;
use App\Models\PackagePricing;
use Illuminate\Support\Facades\Http;

class PackagePricingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $token = session('token');
        $response = Http::withHeaders([
            'Authorization' => 'Token ' . $token,
        ])->get(config('config.base_url').'dashboard/admin-plan/');

        $billing_response = Http::withHeaders([
            'Authorization' => 'Token ' . $token,
        ])->get(config('config.base_url').'dashboard/admin-billing-history/');


        $data = json_decode($response);
        $billing_data = json_decode($billing_response);
        $plans = $data->data;
        $billing_history = $billing_data->data;
//        return $billing_history;
        if($data->status == 200){
            return view('packaging.index',compact(['plans','billing_history']));
        }

        return "Data not found";
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePackagePricingRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(PackagePricing $packagePricing)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PackagePricing $packagePricing)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePackagePricingRequest $request, PackagePricing $packagePricing)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PackagePricing $packagePricing)
    {
        //
    }
}
