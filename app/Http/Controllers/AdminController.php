<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminAuthRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    //method:GET action:Страница входа
    public function signin_page(){
        return view('admin.auth');
    }

    //method:POST action:Действие входа
    public function signin_action(AdminAuthRequest $adminAuthRequest){
        $credentials = $adminAuthRequest->safe()->only(['email','password']);

        // dd($credentials);

        if(Auth::attempt($credentials)){
            $adminAuthRequest->session()->regenerate();

            return response()->json(['Status'=>true]);
        }

        return response()->json(['Status'=>False]);
    }

    //method:GET action:Страница адмиина
    public function index(){
        return view('admin.index');
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return response()->json(["Status"=>True]);
    }
}
