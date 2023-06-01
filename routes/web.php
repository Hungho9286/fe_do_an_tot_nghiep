<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FEClientController;
use App\Http\Middleware\CheckLogin;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::middleware('checklogin')->group(function(){
    Route::get('/dang-nhap',[FEClientController::class,'dangNhap'])->name('dang-nhap');
    Route::post('/dang-nhap',[FEClientController::class,'xuLyDangNhap'])->name('xu-ly-dang-nhap');
    Route::post('/dang-xuat', [FEClientController::class, 'logOut'])->name('dang-xuat');
    Route::get('/thoi-khoa-bieu',[FEClientController::class,'thoiKhoaBieu']);
    Route::get('/thong-tin-ca-nhan',[FEClientController::class,'thongTinCaNhan']);
    Route::get('/dong-hoc-phi',[FEClientController::class,'dongHocPhi']);
    Route::get('/dang-ky-hoc-phan',[FEClientController::class,'dangKyHocPhan']);
    Route::get('/xem-diem',[FEClientController::class,'xemDiem']);
    Route::post('/xu-ly-dong-hoc-phi-momo-qr',[FEClientController::class,'xuLyDongHocPhiMoMoQR'])->name('xu-ly-thanh-toan-momo-qr');
    Route::post('/xu-ly-dong-hoc-phi-momo-atm',[FEClientController::class,'xuLyDongHocPhiMoMoATM'])->name('xu-ly-thanh-toan-momo-atm');
    Route::get('/chon-lop-dang-ky-mon',[FEClientController::class,'chonLopDangKyMon'])->middleware('checknomon');
    Route::get('/', function () {
        return view('layouts.fe.trangchu');
    })->name('trang-chu');
});
Route::get('/cam-on-dong-hoc-phi',[FEClientController::class,'luuThongTinDangKy']);


