<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Models\MoDangKyMon;
use App\Models\MonHoc;
use App\Models\SinhVien;
use App\Models\LopHocPhan;
use App\Models\CtChuongTrinhDaoTao;
use App\Models\ChuongTrinhDaoTao;
use App\Models\ThoiKhoaBieu;
use App\Models\ThoiGianBieu;
use App\Models\ChiTietLopHocPhan;
use App\Models\DangKyLopHocPhan;

class APIDangKyLopHocPhanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function themDangKyLopHocPhan(Request $request){
        $tienDong=550000;
        $sinhvien=SinhVien::find($request->id_sinh_vien);
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $currenDateTime= date('Y-m-d H:i:s');
        //dd($currenDateTime);

        $monHocRot=CtChuongTrinhDaoTao::join('lop_hoc_phans','lop_hoc_phans.id_ct_chuong_trinh_dao_tao','ct_chuong_trinh_dao_taos.id')
                                      ->join('chi_tiet_lop_hoc_phans','chi_tiet_lop_hoc_phans.id_lop_hoc_phan','lop_hoc_phans.id')
                                      ->where('ct_chuong_trinh_dao_taos.id_mon_hoc',$request->id_mon_hoc)
                                      ->where('chi_tiet_lop_hoc_phans.id_sinh_vien',$sinhvien->id)
                                      ->orderBy('chi_tiet_lop_hoc_phans.created_at','desc')
                                    //   ->get();
                                      ->first();

        if($monHocRot!=null&&$monHocRot->tong_ket_2!=null){
            if($monHocRot->tong_ket_2<5){

                $moDangKyMon=MoDangKyMon::where('id_mon_hoc',$request->id_mon_hoc)
                                    ->where('khoa_hoc',$sinhvien->khoa_hoc)
                                    ->where('mo_dang_ky','<',$currenDateTime)
                                    ->where('dong_dang_ky','>',$currenDateTime)
                                    ->where('da_dong','=',0)
                                    ->first();
                //dd($moDangKyMon);
                if($moDangKyMon!=null){
                    $lopHocPhanDangKy=LopHocPhan::join('ct_chuong_trinh_dao_taos','ct_chuong_trinh_dao_taos.id','lop_hoc_phans.id_ct_chuong_trinh_dao_tao')
                                                ->where('lop_hoc_phans.id',$request->id_lop_hoc_phan)
                                                ->first();

                    if($lopHocPhanDangKy!=null&&$lopHocPhanDangKy->id_mon_hoc==$request->id_mon_hoc){
                        $monHoc=MonHoc::find($request->id_mon_hoc);
                        $tienDong=150000*$monHoc->sotinchi;
                        DangKyLopHocPhan::create([
                            'id_lop_hoc_phan'=>$request->id_lop_hoc_phan,
                            'id_sinh_vien'=>$sinhvien->id,
                            'tien_dong'=>$tienDong,
                        ]);
                        return 'ok';
                    }else{
                        return response()->json([
                            'message'=>"Không tìm thấy lớp học phần cần đăng ký"
                        ], 200);
                    }
                }else{
                    return response()->json([
                        'message'=>"Chưa mở đăng ký môn"
                    ], 200);
                }
            }

        }else{
            return response()->json([
                'message'=>"Đăng ký không thành công do không nợ môn"
            ], 200);
        }


    }
}
