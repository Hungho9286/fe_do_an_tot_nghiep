<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FEClientController;
use App\Http\Controllers\FEGiangVienController;
use App\Http\Controllers\ThoiKhoaBieuController;
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
    Route::get('/dong-hoc-phi',[FEClientController::class,'dongHocPhi'])->name('dong-hoc-phi');
    Route::get('/dang-ky-hoc-phan',[FEClientController::class,'dangKyHocPhan']);
    Route::get('/xem-diem',[FEClientController::class,'xemDiem']);
    Route::post('/xu-ly-dong-hoc-phi-momo-qr',[FEClientController::class,'xuLyDongHocPhiMoMoQR'])->name('xu-ly-thanh-toan-momo-qr');
    Route::post('/xu-ly-dong-hoc-phi-momo-atm',[FEClientController::class,'xuLyDongHocPhiMoMoATM'])->name('xu-ly-thanh-toan-momo-atm');
    Route::get('/chon-lop-dang-ky-mon',[FEClientController::class,'chonLopDangKyMon'])->middleware('checknomon');
    Route::get('/', function () {
        return view('layouts.fe.trangchu');
    })->name('trang-chu');
});
Route::post('dong-hoc-phi-paypal',[FEClientController::class,'xuLyDongHocPhiPayPal'])->name('dong-hoc-phi-qua-paypal');
Route::get('/xu-ly-dong-hoc-phi-paypal',[FEClientController::class,'luuThongTinDangKy'])->name('xu-ly-dong-hoc-phi-paypal');
Route::get('/cam-on-dong-hoc-phi',[FEClientController::class,'hienThiTrangCamOnDongHocPhi'])->name('cam-on-dong-hoc-phi');
Route::get('/cancel-dong-hoc-phi',[FEClientController::class,'huyDongHocPhi'])->name('cancel-dong-hoc-phi');
Route::post('/dong-hoc-phi-vnpay',[FEClientController::class,'xuLyDongHocPhiVNPay'])->name('xy-ly-dong-hoc-phi-vnpay');
Route::get('/cam-on-dong-hoc-phi-vnpay',[FEClientController::class,'luuThongTinDongHocPhiVNPay'])->name('luu-thong-tin-dong-hoc-phi-vnpay');
Route::get('/giang-vien/trang-chu',[FEGiangVienController::class,'index'])->name('trang-chu-giang-vien');
Route::get('/giangvien/lop-hoc-phan-cua-giang-vien',[FEGiangVienController::class,'lopHocPhanCuaGiangVien'])->name('danh-sach-lop-hoc-phan');

Route::get('/giangvien/thongbao',[FEGiangVienController::class,'thongbaosinhvien']);
Route::get('/giangvien/thongbao/xoa/{id}',[FEGiangVienController::class,'destroy']);
Route::get('/giangvien/thongbao/lay-thong-bao-sua',[FEGiangVienController::class,'laythongbao'])->name('lay-thong-bao');
Route::get('/giangvien/thongbao/sua',[FEGiangVienController::class,'suathongbao']);
Route::get('/giang-vien/danh-sach-lop-hoc-phan/danh-sach-sinh-vien/{id}',[FEGiangVienController::class,'danhSachSinhVienTheoLopHocPhan'])->name('lop-hoc-phan-cua-giang-vien');
Route::get('/giang-vien/danh-sach-lop-hoc-phan/danh-sach-sinh-vien/{id}/thong-tin-sinh-vien',[FEGiangVienController::class,'xemThongTinSinhVien']);

Route::get('giang-vien/lop-hoc-phan/xem-diem/{id}',[FEGiangVienController::class,'diemsinhvien']);
Route::get('/giang-vien/thong-tin-giang-vien',[FEGiangVienController::class,'show'])->name('thong-tin-giang-vien');

Route::get('/giang-vien/thoi-khoa-bieu',[ThoiKhoaBieuController::class,'thoikhoabieu_giangvien'])->name('thoi-khoa-bieu-giang-vien');