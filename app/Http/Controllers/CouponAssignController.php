<?php

namespace App\Http\Controllers;

use App\Exports\ExportExcelFile;
use App\Http\Requests\StoreCouponAssignRequest;
use App\Http\Requests\UpdateCouponAssignRequest;
use App\Models\CouponAssign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Facades\Excel;

class CouponAssignController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $token = session('token');
        $response = Http::withHeaders([
            'Authorization' => 'Token ' . $token,
        ])->get(config('config.base_url').'dashboard/admin-assign/?q=participant');

        $manager_response = Http::withHeaders([
            'Authorization' => 'Token ' . $token,
        ])->get(config('config.base_url').'dashboard/admin-assign/?q=manager');

        $scanner_response = Http::withHeaders([
            'Authorization' => 'Token ' . $token,
        ])->get(config('config.base_url').'dashboard/admin-user/get-scanner');

        $data = json_decode($response);
        $assign_users = $data->data;

        $manager_response_data = json_decode($manager_response);
        $manager_decode_data = $manager_response_data->data;

        $scanner_data = json_decode($scanner_response);
        $scanner_decode_users = $scanner_data->data;

        if($data->status == 200){
            return view('coupon-assign.index',compact('assign_users','manager_decode_data','scanner_decode_users'));
        }else{
            return "Something went wrong";
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $token = session('token');
        $response = Http::withHeaders([
            'Authorization' => 'Token ' . $token,
        ])->get(config('config.base_url').'dashboard/admin-user/assign-to');

        $data = json_decode($response);

        $users = $data->data;
        return view('coupon-assign.create', compact('users'));
    }

    public function scannerCreate()
    {
        return view('coupon-assign.add-scanner');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCouponAssignRequest $request)
    {
        $token = session('token');
        $response = Http::withHeaders([
            'Authorization' => 'Token ' . $token,
        ])->post(config('config.base_url').'dashboard/admin-assign/', [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'organization' => $request->input('organization'),
            'collected_by' => $request->input('collected_by'),
            'assign_to' => $request->input('assign_to'),
            'coupon_type' => $request->input('coupon_type'),
            'number_of_coupon' => $request->input('number_of_coupon'),
            'note' => $request->input('note'),
        ]);

        $data = json_decode($response);
        if($data->status == 200){
            return redirect()->route('coupon-assign.index')->with('message', 'Coupon assigned successfully');
        }else{
            return "Something went wrong";
        }
    }

    public function scannerStore(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'organization' => 'required',
        ]);

        $token = session('token');
        $response = Http::withHeaders([
            'Authorization' => 'Token ' . $token,
        ])->post(config('config.base_url').'dashboard/admin-user/add-scanner/', [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'organization' => $request->input('organization'),
            'note' => $request->input('note'),
        ]);

        $data = json_decode($response);
        if($data->status == 200){
            return redirect()->route('coupon-assign.index')->with('message', 'Scanner created successfully');
        }else{
            return "Something went wrong";
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(CouponAssign $couponAssign)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($couponAssign_id)
    {
        $token = session('token');
        $response = Http::withHeaders([
            'Authorization' => 'Token ' . $token,
        ])->get(config('config.base_url').'dashboard/admin-assign/'.$couponAssign_id.'/');

        $user_response = Http::withHeaders([
            'Authorization' => 'Token ' . $token,
        ])->get(config('config.base_url').'dashboard/admin-user/assign-to');

        $user_data = json_decode($user_response);

        $users = $user_data->data;


        $data = json_decode($response);
        $assign_users = $data->data;

        if($data->status == 200){
            return view('coupon-assign.edit',compact('assign_users','users'));
        }else{
            return "Something went wrong";
        }
    }

    public function scannerEdit($scanner_id)
    {
        $token = session('token');
        $response = Http::withHeaders([
            'Authorization' => 'Token ' . $token,
        ])->get(config('config.base_url').'user/'.$scanner_id.'/');


        $data = json_decode($response);
        $assign_users = $data->data;

        if($data->status == 200){
            return view('coupon-assign.edit-scanner',compact('assign_users'));
        }else{
            return "Something went wrong";
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCouponAssignRequest $request, $couponAssign_id)
    {
        $token = session('token');
        $response = Http::withHeaders([
            'Authorization' => 'Token ' . $token,
        ])->patch(config('config.base_url').'dashboard/admin-assign/'.$couponAssign_id.'/', [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'organization' => $request->input('organization'),
            'collected_by' => $request->input('collected_by'),
            'assign_to' => $request->input('assign_to'),
            'coupon_type' => $request->input('coupon_type'),
            'number_of_coupon' => $request->input('number_of_coupon'),
            'note' => $request->input('note'),
        ]);

        $data = json_decode($response);
        if($data->status == 200){
            return redirect()->route('coupon-assign.index')->with('message', 'Assign coupon updated successfully');
        }else{
            return "Something went wrong";
        }
    }

    public function scannerUpdate(Request $request, $scanner_id)
    {
        $token = session('token');
        $response = Http::withHeaders([
            'Authorization' => 'Token ' . $token,
        ])->patch(config('config.base_url').'user/info/'.$scanner_id.'/', [
            'name' => $request->input('name'),
            'company' => $request->input('organization'),
            'note' => $request->input('note'),
        ]);

        $data = json_decode($response);
        if($data->status == 200){
            return redirect()->route('coupon-assign.index')->with('message', 'Scanner updated successfully');
        }else{
            return "Something went wrong";
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $token = session('token');
        $response = Http::withHeaders([
            'Authorization' => 'Token ' . $token,
        ])->post(config('config.base_url').'dashboard/admin-assign/remove_participants/', [
            'ids' => $request->input('ids'),
        ]);

        $data = json_decode($response);
        if($data->status == 204){
            return redirect()->route('coupon-assign.index')->with('message', 'Employee created successfully');
        }else{
            return "Something went wrong";
        }
    }

    public function scannerDestroy(Request $request)
    {
        $token = session('token');
        $response = Http::withHeaders([
            'Authorization' => 'Token ' . $token,
        ])->post(config('config.base_url').'dashboard/admin-user/remove-user/', [
            'ids' => $request->input('ids'),
        ]);

        $data = json_decode($response);

        if($data->status == 204){
            return redirect()->route('coupon-assign.index')->with('message', 'Scanner deleted successfully');
        }else{
            return "Something went wrong";
        }
    }

    public function exportExcelFile()
    {
        return Excel::download(new ExportExcelFile(),'sample.xlsx');
    }
    public function participantUploadCreate()
    {
        return view('coupon-assign.upload-participant');
    }

    public function participantUpload(Request $request)
    {
        $request->validate([
            'xlsx_file' => 'required',
        ]);

        $token = session('token');
        $response = Http::withHeaders([
            'Authorization' => 'Token ' . $token,
        ])->post(config('config.base_url').'dashboard/admin-assign/upload-participants/', [
            'xlsx_file' => $request->input('xlsx_file'),
        ]);

//        $data = json_decode($response);
//        if($data->status == 200){
            return redirect()->route('coupon-assign.index')->with('message', 'Excel file uploaded successfully');
//        }else{
//            return "Something went wrong";
//        }
    }

}
