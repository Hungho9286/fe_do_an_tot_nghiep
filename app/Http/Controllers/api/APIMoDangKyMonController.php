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

class APIMoDangKyMonController extends Controller
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
    public function choPhepMoDangKyMon(Request $request){
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $currenDateTime= date('Y-m-d H:i:s');
        //dd($request->all());
        $moDangKyMon=MoDangKyMon::where('id_mon_hoc',$request->id_mon_hoc)
        ->where('khoa_hoc',$request->khoa_hoc)
        ->where('mo_dang_ky','<',$currenDateTime)
        ->where('dong_dang_ky','>',$currenDateTime)
        ->where('da_dong',0)
        ->first();
        //dd($moDangKyMon);
        if($moDangKyMon!=null){
            return response()->json(
                [
                    'trang_thai'=>1,
                    'mo_dang_ky'=>$moDangKyMon->mo_dang_ky,
                    'dong_dang_ky'=>$moDangKyMon->dong_dang_ky,
                    'message'=>"Cho phép đăng ký môn"
                ], 200,);
        }
        return response()->json([
            'trang_thai'=>0,
            'message'=>"Chưa mở đăng ký"
        ], 200);
    }
    public function hienThiDanhSachDangKyMonHocCuaSinhVien($id){
        $sinhvien=SinhVien::find($id);
        $monHocTheoChuongTrinhDaoTao=CtChuongTrinhDaoTao::join('chuong_trinh_dao_taos','chuong_trinh_dao_taos.id','ct_chuong_trinh_dao_taos.id_chuong_trinh_dao_tao')
                                    ->join('mon_hocs','mon_hocs.id','ct_chuong_trinh_dao_taos.id_mon_hoc')
                                    ->where('chuong_trinh_dao_taos.khoa',$sinhvien->khoa_hoc)
                                    ->get();
        //dd($monHocTheoChuongTrinhDaoTao);
       if($monHocTheoChuongTrinhDaoTao->count()>0){
        $data=array();
            foreach($monHocTheoChuongTrinhDaoTao as $item){
                $diemMonHoc=LopHocPhan::join('chi_tiet_lop_hoc_phans','chi_tiet_lop_hoc_phans.id_lop_hoc_phan','lop_hoc_phans.id')
                                      ->join('ct_chuong_trinh_dao_taos','ct_chuong_trinh_dao_taos.id','lop_hoc_phans.id_ct_chuong_trinh_dao_tao')
                                      ->where('ct_chuong_trinh_dao_taos.id_mon_hoc','=',$item->id_mon_hoc)
                                      ->where('chi_tiet_lop_hoc_phans.id_sinh_vien',$sinhvien->id)
                                      ->orderBy('chi_tiet_lop_hoc_phans.created_at','desc')
                                      ->first();
                //dd($diemMonHoc);
                if($diemMonHoc!=null &&$diemMonHoc->tong_ket_2!=null){
                    //dd($diemMonHoc);
                    if($diemMonHoc->tong_ket_2<5){
                        $data[]=array(
                            'ten_mon_hoc'=>$item->ten,
                            'id_mon_hoc'=>$item->id_mon_hoc
                        );
                    }
                }
            }
        //dd($monHocRot->all());
        // $data=array();
        // foreach($monHocRot as $item){
        //     $data[]=array(
        //         'ten_mon_hoc'=>$item->ten,
        //         'id_mon_hoc_rot'=>$item->id_mon_hoc
        // );

        // }
        if(count($data)==0){
            return response()->json(
                [
                    "message"=>"Not Found"
                ]

            , 200);
        }else{
            return json_encode($data);
        }


       }else{

        return response()->json(
            [
                "message"=>"Not Found"
            ]

        , 200);
       }
    }

}
