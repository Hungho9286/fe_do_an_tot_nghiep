<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\APISinhVienController;
use App\Http\Controllers\api\APIThoiKhoaBieuController;
use App\Http\Controllers\api\APIPhongHocController;
use App\Http\Controllers\api\APIThoiGianBieuController;
use App\Http\Controllers\api\APILopHocPhanController;
use App\Http\Controllers\api\APIMonHocController;
use App\Http\Controllers\api\APIGiangVienController;
use App\Http\Controllers\api\APIThongBaoController;
use App\Http\Controllers\api\APIMoDangKyMonController;
use App\Http\Controllers\api\APIDangKyLopHocPhanController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/sinh-vien/{id}',[APISinhVienController::class,'show']);
Route::get('/thoi-khoa-bieu',[APIThoiKhoaBieuController::class,'index']);
Route::get('/phong-hoc/{id}',[APIPhongHocController::class,'show']);
Route::get('/thoi-gian-bieu/{id}',[APIThoiGianBieuController::class,'show']);
Route::get('/giang-vien/{id}',[APIGiangVienController::class,'show']);
Route::get('/mon-hoc/{id}',[APIMonHocController::class,'show']);
Route::get('/lop-hoc-phan/{id}',[APILopHocPhanController::class,'show']);
Route::get('/thoi-khoa-bieu/{id}',[APIThoiKhoaBieuController::class,'getLichHoc']);
Route::get('/danh-sach-thong-bao/{id}',[APIThongBaoController::class,'layDanhSachThongBaoCuaSinhVien']);
Route::get('/danh-sach-diem-cua-sinh-vien/{id}',[APISinhVienController::class,'layBangDiemCuaSinhVien']);
Route::get('/danh-sach-diem-cua-sinh-vien/{id}/hoc-ky/{hocky}',[APISinhVienController::class,'layBangDiemCuaSinhVienTheoHocKy']);
Route::get('/thoi-khoa-bieu-cua-sinh-vien/{id}',[APIThoiKhoaBieuController::class,'danhSachLichHocCuaSinhVien']);
Route::get('/danh-sach-dang-ky-mon-cua-sinh-vien/{id}',[APIMoDangKyMonController::class,'hienThiDanhSachDangKyMonHocCuaSinhVien']);
Route::get('/mo-dang-ky-mon',[APIMoDangKyMonController::class,'choPhepMoDangKyMon']);
Route::post('/them-dang-ky-lop-hoc-phan',[APIDangKyLopHocPhanController::class,'themDangKyLopHocPhan']);
Route::get('/danh-sach-lop-hoc-phan-theo-mon-con-mo/{id}',[APILopHocPhanController::class,'danhSachLopHocPhanConMoThuocMonHoc']);

Route::post('/xu-li-dong-hoc-phi',[FEClientController::class,'luuThongTinDangKy'])->name('cam-on-dong-hoc-phi');
