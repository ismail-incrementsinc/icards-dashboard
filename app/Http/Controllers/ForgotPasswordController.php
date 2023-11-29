<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreForgotPasswordRequest;
use App\Http\Requests\UpdateForgotPasswordRequest;
use App\Models\ForgotPassword;
use Illuminate\Support\Facades\Http;

class ForgotPasswordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('auth.forgot-password');
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
    public function store(StoreForgotPasswordRequest $request)
    {
        $response = Http::post(config('config.base_url').'dashboard/admin-user/forgot-password-email-send/', [
            'email' => $request->input('email'),
        ]);

        $data = json_decode($response);
        if ($response->status() == 200){
            if($data->status == 404){
                return redirect()->route('forgot-password')->with('warning',$data->detail);
            }else{
                return redirect()->route('login')->with('message','Check your email');
            }
        }else{
            return redirect()->route('forgot-password')->with('error','Something went wrong');
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(ForgotPassword $forgotPassword)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ForgotPassword $forgotPassword)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateForgotPasswordRequest $request, ForgotPassword $forgotPassword)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ForgotPassword $forgotPassword)
    {
        //
    }
}
