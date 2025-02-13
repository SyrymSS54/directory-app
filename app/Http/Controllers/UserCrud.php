<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\DeleteRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserCrud extends Controller
{
    //method:POST action:создание пользователя
    public function create_user(Request $request,User $user){
        $validator = Validator::make($request->all(),[
            "email"=>"required|email|unique:App\Models\User,email",
            "full_name"=>"required|string",
            "password"=>"required|min:8"
        ]);

        if($validator->fails()){
            return response()->json(['Status'=>false]);
        };

        $validated = $validator->validated();

        $user->email=$validated['email'];
        $user->full_name = $validated['full_name'];
        $user->role=2;
        $user->password = Hash::make($validated['password']);
        $user->save();

        return response()->json(['Status'=>true]);
    }

    //method:PUT action:обновление пользователя
    public function update_user(Request $request){
        $validator = Validator::make($request->all(),[
            "id"=>"required",
            "email"=>"email",
            "full_name"=>"string",
            "password"=>"min:8"
        ]);

        if($validator->fails()){
            return response()->json(['Status'=>false]);
        };

        $validated = $validator->validated();

        $user = User::find($validated['id']);
        $user->email=$validated['email'];
        $user->full_name = $validated['full_name'];
        $user->password = Hash::make($validated['password']);
        $user->save();

        return response()->json(['Status'=>true]);
    }

    //method:GET action:список пользователей
    public function review_users(){
        return response()->json(["data"=>User::where("role","!=",1)->get(["email",'full_name',"id"])]);
    }

    //method:DELETE action:удаление пользователя
    public function delete_user(Request $request){
        $validator = Validator::make($request->all(),[
            "id"=>"required"
        ]);

        if($validator->fails()){
            return response()->json(['Status'=>false]);
        };

        $validated = $validator->validated();

        $user=User::find($validated['id']);
        $user->delete();
        
        return response()->json(['Status'=>True]);
    }
}
