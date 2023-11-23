<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLoginRequest;
use App\Http\Requests\UpdateLoginRequest;
use App\Models\Login;
use Illuminate\Support\Facades\Http;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        return view('auth.login');
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
    public function store(StoreLoginRequest $request)
    {
        $response = Http::post(config('config.base_url').'user/admin-login/', [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
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
            return redirect()->route('login')->with('warning',$data->detail);
        }else{
            return redirect()->route('login')->with('error',$data->detail);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Login $login)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Login $login)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLoginRequest $request, Login $login)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        $token = session('token');
        $response = Http::withHeaders([
            'Authorization' => 'Token ' . $token,
        ])->get(config('config.base_url').'user/logout/');

        if (session()->has('id') && session()->has('token')) {
            session()->forget(['id','name','email','logo','token','status']);
            session()->flush();
            return redirect()->route('login');
        }
        return false;
    }
}
