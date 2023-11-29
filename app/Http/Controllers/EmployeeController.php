<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Models\Employee;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $token = session('token');
        $response = Http::withHeaders([
            'Authorization' => 'Token ' . $token,
        ])->get(config('config.base_url').'dashboard/admin-users/?q=employees');

        $data = json_decode($response);
        $employees = $data->data;
        if($data->status == 200){
            return view('employee.index',compact('employees'));
        }else{
            return "Something went wrong";
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('employee.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEmployeeRequest $request)
    {
        $token = session('token');
        $response = Http::withHeaders([
            'Authorization' => 'Token ' . $token,
        ])->post(config('config.base_url').'dashboard/admin-users/', [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'image' => $request->input('image'),
            'is_sub_admin' => $request->input('is_sub_admin'),
            'info' => [
                'company' => $request->input('company'),
                'designation' => $request->input('designation'),
                'dob' => $request->input('dob'),
                'phone' => $request->input('phone'),
                'address' => $request->input('address'),
            ],
        ]);

        if($response->status() == 200){
            return redirect()->route('employee.index')->with('message', 'Employee created successfully');
        }else{
            return "Something went wrong";
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($employee_id)
    {
        $token = session('token');
        $response = Http::withHeaders([
            'Authorization' => 'Token ' . $token,
        ])->get(config('config.base_url').'dashboard/admin-users/'.$employee_id);
        $data = json_decode($response);

        $employee =  $data->data;
        if($response->status() == 200){
            return view('employee.edit',compact('employee'));
        }else{
            return "Something went wrong";
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmployeeRequest $request, $employee_id)
    {
        $token = session('token');
        $response = Http::withHeaders([
            'Authorization' => 'Token ' . $token,
        ])->patch(config('config.base_url').'user/info/'.$employee_id.'/', [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'image' => $request->input('image'),
            'is_sub_admin' => $request->input('is_sub_admin'),
            'company' => $request->input('company'),
            'designation' => $request->input('designation'),
            'dob' => $request->input('dob'),
            'phone' => $request->input('phone'),
            'address' => $request->input('address'),
        ]);

        $data = json_decode($response);
        if($data->status == 200){
            return redirect()->route('employee.index')->with('message', 'Employee created successfully');
        }else{
            return "Something went wrong";
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($employee_id)
    {
        $token = session('token');
        $response = Http::withHeaders([
            'Authorization' => 'Token ' . $token,
        ])->delete(config('config.base_url').'admin-users/'.$employee_id.'/');
        return true;

    }

    public function uploadCreate()
    {
        return view('employee.upload-create');
    }

    public function upload(Request $request)
    {
        $token = session('token');

        $response = Http::withHeaders([
            'Authorization' => 'Token ' . $token,
        ])->post(config('config.base_url').'dashboard/admin-user/upload-employee/', [
            'xlsx_file' => $request->input('xlsx_file'),
        ]);

        $data = json_decode($response);
        if($data->status == 200){
            return redirect()->route('employee.index')->with('message', 'File uploaded successfully');
        }else{
            return "Something went wrong";
        }
    }
}
