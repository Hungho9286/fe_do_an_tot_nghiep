<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Models\ThoiKhoaBieu;
use App\Models\ThoiGianBieu;
use App\Models\GiangVien;
use App\Models\MonHoc;
use App\Models\LopHocPhan;
use App\Models\PhongHoc;
use App\Models\CtChuongTrinhDaoTao;
class APIThoiKhoaBieuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ThoiKhoaBieu::all();
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

    public function getLichHoc($id){
        $ThoiKhoaBieu=ThoiKhoaBieu::find($id);
        $PhongHoc=PhongHoc::find($ThoiKhoaBieu->id_phong_hoc);
        $LopHocPhan=LopHocPhan::find($ThoiKhoaBieu->id_lop_hoc_phan);
        $CtChuongTrinhDaoTao=CtChuongTrinhDaoTao::find($LopHocPhan->id_ct_chuong_trinh_dao_tao);
        $GiangVien=GiangVien::find($LopHocPhan->id_giang_vien_1);
        $MonHoc=MonHoc::find($CtChuongTrinhDaoTao->id_mon_hoc);
        $TietBatDau=ThoiGianBieu::find($ThoiKhoaBieu->tietbatdau);
        $TietKetThuc=ThoiGianBieu::find($ThoiKhoaBieu->tietketthuc);
         return response()->json([
            'data'=>[
                'id'=>$ThoiKhoaBieu->id,
                'id_phong_hoc'=>$PhongHoc->id,
                'id_lop_hoc_phan'=>$LopHocPhan->id,
                'ten_phong_hoc'=>$PhongHoc->ten_phong_hoc,
                'id_mon_hoc'=>$MonHoc->id,
                'ten_mon_hoc'=>$MonHoc->ten,
                'id_giang_vien'=>$GiangVien->id,
                'ten_giang_vien'=>$GiangVien->ten_gv,
                'tiet_bat_dau'=>$TietBatDau->stt,
                'tiet_ket_thuc'=>$TietKetThuc->stt,
                'thoi_gian_bat_dau'=>$TietBatDau->thoigianbatdau,
                'thoi_gian_ket_thuc'=>$TietKetThuc->thoigianketthuc,
                'thu_trong_tuan'=>$ThoiKhoaBieu->thu_trong_tuan,
            ]


         , 'status'=>200]);
    }
    public function danhSachLichHocCuaSinhVien($id){
        $thoiKhoaBieu= ThoiKhoaBieu::join('lop_hoc_phans','thoi_khoa_bieus.id_lop_hoc_phan','lop_hoc_phans.id')
                                ->join('chi_tiet_lop_hoc_phans','chi_tiet_lop_hoc_phans.id_lop_hoc_phan','lop_hoc_phans.id')
                                ->join('ct_chuong_trinh_dao_taos','ct_chuong_trinh_dao_taos.id','lop_hoc_phans.id_ct_chuong_trinh_dao_tao')
                                ->join('mon_hocs','mon_hocs.id','ct_chuong_trinh_dao_taos.id_mon_hoc')
                                ->join('phong_hocs','phong_hocs.id','thoi_khoa_bieus.id_phong_hoc')

                                ->where('mo_lop',1)
                                ->where('chi_tiet_lop_hoc_phans.id_sinh_vien',$id);
       // dd($thoiKhoaBieu->get());
        $phongHoc= clone $thoiKhoaBieu;
        $phongHoc=$phongHoc->select('ten_phong_hoc','id_phong_hoc')->distinct()->get();
        //dd($phongHoc);
        $data=array();
        foreach($phongHoc as $p){
            $lichThuocPhong=array();
            $lichHoc=clone $thoiKhoaBieu;
            $lichHoc=$lichHoc->where('id_phong_hoc',$p->id_phong_hoc)->get();
            //dd($lichHoc);
            foreach($lichHoc as $lich){
                $tietBatDau=ThoiGianBieu::find($lich->tietbatdau);
                $tietKetThuc=ThoiGianBieu::find($lich->tietketthuc);
                $giangVien1=GiangVien::find($lich->id_giang_vien_1);
                $giangVien2=GiangVien::find($lich->id_giang_vien_2);
                $lichThuocPhong[]=array(
                    'mon_hoc'=>$lich->ten,
                    'hoc_ky'=>$lich->hocky,
                    'giang_vien_1'=>$giangVien1!=null?$giangVien1->ten_gv:"Empty",
                    'giang_vien_2'=>$giangVien2!=null?$giangVien2->ten_gv:"Empty",
                    'thu_trong_tuan'=>$lich->thu_trong_tuan,
                    'tiet_bat_dau'=>$tietBatDau->stt,
                    'thoi_gian_bat_dau'=>$tietBatDau->thoigianbatdau,
                    'tiet_ket_thuc'=>$tietKetThuc->stt,
                    'thoi_gian_ket_thuc'=>$tietKetThuc->thoigianketthuc
                );
            }
            $data[]=array(
                'id_phong_hoc'=>$p->id_phong_hoc,
                'ten_phong_hoc'=>$p->ten_phong_hoc,
                'lich'=>$lichThuocPhong
            );
        }
        return $data;

    }
}
