<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRegisterRequest;
use App\Http\Requests\UpdateRegisterRequest;
use App\Models\Register;
use Illuminate\Support\Facades\Http;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('auth.register');
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
    public function store(StoreRegisterRequest $request)
    {
        $response = Http::post(config('config.base_url').'user/create-admin/', [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'logo' => base64_encode(file_get_contents($request->file('logo')->path())),
        ]);

        $data = json_decode($response);
        if($data->status == 200){
            $user_info = $data->data;
            session([
                'id'=>$user_info->id,
                'name'=>$user_info->name,
                'email'=>$user_info->email,
                'logo'=>$user_info->logo,
                'token' => $data->token,
                'status' => $data->status,
                ]);
            return redirect()->route('dashboard')->with('message',$data->detail);
        }elseif($data->status == 400){
            return redirect()->route('register')->with('warning',$data->detail);
        }else{
            return redirect()->route('register')->with('error',$data->detail);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Register $register)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Register $register)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRegisterRequest $request, Register $register)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Register $register)
    {
        //
    }
}
