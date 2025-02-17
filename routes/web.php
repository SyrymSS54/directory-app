<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserCrud;
use App\Http\Middleware\CheckAdmin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect(route("login"));
});

Route::controller(AdminController::class)->group(function(){
    Route::get('/admin/signin','signin_page')->name('login'); //страница входа
    Route::get('/admin','index')->name('admin.index')->middleware(CheckAdmin::class); //страницца админа

    Route::post('/admin/signin','signin_action'); //ресурс для авторизации
    Route::get('/admin/logout','logout'); //ресурс для выхода
    Route::get('/info',function(){
        return response()->json([Auth::user()]);
    });
});

Route::controller(UserCrud::class)->group(function(){
    Route::get('/admin/users','review_users')->middleware(CheckAdmin::class);
    Route::post("/admin/users/add","create_user")->middleware(CheckAdmin::class);
    Route::post("/admin/users/delete","delete_user")->middleware(CheckAdmin::class);
    Route::post("/admin/users/update","update_user")->middleware(CheckAdmin::class);
});
