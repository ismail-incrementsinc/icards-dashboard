<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDashboardRequest;
use App\Http\Requests\UpdateDashboardRequest;
use App\Models\Dashboard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user_count_url = config('config.base_url').'dashboard/admin-insights/?q=user_count';
        $card_scan_url = config('config.base_url').'dashboard/admin-insights/?q=card_scan';

        if(isset($_GET['user_count_year'])){
            $user_count_url = config('config.base_url').'dashboard/admin-insights/?q=user_count&year='.$request->input('user_count_year');
        }
        if(isset($_GET['user_count_month'])){
            $user_count_url = config('config.base_url').'dashboard/admin-insights/?q=user_count&month='.$request->input('user_count_month');
        }

        if(isset($_GET['card_scan_year'])){
            $card_scan_url = config('config.base_url').'dashboard/admin-insights/?q=card_scan&year='.$request->input('card_scan_year');
        }
        if(isset($_GET['card_scan_month'])){
            $card_scan_url = config('config.base_url').'dashboard/admin-insights/?q=card_scan&month='.$request->input('card_scan_month');
        }

        $token = session('token');
        $response = Http::withHeaders([
            'Authorization' => 'Token ' . $token,
        ])->get(config('config.base_url').'dashboard/admin-insights/?q=scan_user');


        $user_count_response = Http::withHeaders([
            'Authorization' => 'Token ' . $token,
        ])->get($user_count_url);

        $card_scan_response = Http::withHeaders([
            'Authorization' => 'Token ' . $token,
        ])->get($card_scan_url);

        $data = json_decode($response);
        $users = $data->data;

        $user_count_response_data = json_decode($user_count_response);
        $user_count_decode_data = $user_count_response_data->data;

        $card_scan_response_data = json_decode($card_scan_response);
        $card_scan_decode_data = $card_scan_response_data->data;


        if($data->status == 200){
            return view('index',compact(['users','user_count_decode_data','card_scan_decode_data']));
        }else{
            return "Data not found";
        }
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
    public function store(StoreDashboardRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Dashboard $dashboard)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dashboard $dashboard)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDashboardRequest $request, Dashboard $dashboard)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dashboard $dashboard)
    {
        //
    }
}
