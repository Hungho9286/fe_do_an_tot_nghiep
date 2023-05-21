<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Models\LopHocPhan;
use App\Models\MonHoc;
use App\Models\ThoiKhoaBieu;
use App\Models\ThoiGianBieu;
use App\Models\GiangVien;
use App\Models\PhongHoc;

class APILopHocPhanController extends Controller
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
        return LopHocPhan::find($id);
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
    public function danhSachLopHocPhanConMoThuocMonHoc($id){
        $lopHocPhan=LopHocPhan::join('ct_chuong_trinh_dao_taos','ct_chuong_trinh_dao_taos.id','lop_hoc_phans.id_ct_chuong_trinh_dao_tao')
                              ->where('ct_chuong_trinh_dao_taos.id_mon_hoc',$id)
                              ->where('lop_hoc_phans.mo_lop',1)->get();
        //dd($lopHocPhan);
        $data=array();
        foreach($lopHocPhan as $item){
            $giangVien1=GiangVien::find($item->id_giang_vien_1);
            $giangVien2=GiangVien::find($item->id_giang_vien_2);
            //dd($giangVien2);
            $thoiKhoaBieu=ThoiKhoaBieu::where('id_lop_hoc_phan',$item->id)->get();
            $dataThoiKhoaBieu=array();

            foreach($thoiKhoaBieu as $tkb){
                $tietBatDau=ThoiGianBieu::find($tkb->tietbatdau);
                $tietKetThuc=ThoiGianBieu::find($tkb->tietketthuc);
                $phongHoc=PhongHoc::find($tkb->id_phong_hoc);
                $dataThoiKhoaBieu[]=array(
                    'phong_hoc'=>$phongHoc->ten_phong_hoc,
                    'thu'=>$tkb->thu_trong_tuan,
                    'tiet_bat_dau'=>$tietBatDau->stt,
                    'thoi_gian_bat_dau'=>$tietBatDau->thoigianbatdau,
                    'tiet_ket_thuc'=>$tietKetThuc->stt,
                    'thoi_gian_ket_thuc'=>$tietKetThuc->thoigianketthuc,
                );
            }
            $data[]=array(
                'id_lop_hoc_phan'=>$item->id,
                'giang_vien_1'=>$giangVien1->ten_gv,
                'giang_vien_2'=>$giangVien2!=null?$giangVien2->ten_gv:"Empty",
                'lich_hoc'=>$dataThoiKhoaBieu,
            );
        }
        return $data;
    }
}
