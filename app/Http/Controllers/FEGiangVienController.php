<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FEGiangVienController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('giangvien.trangchu');
    }
    public function thongbaosinhvien()
    {
        return view('giangvien.thongbaosv');
    }
    public function lopHocPhanCuaGiangVien(){
        return view('giangvien.lophocphan');
    }
    public function danhSachSinhVienTheoLopHocPhan($id){
        return view('giangvien.danhsachsinhvientheolop',['id_lop_hoc_phan'=>$id]);
    }
    public function xemThongTinSinhVien($id_lop_hoc_phan,Request $request){
        return view('giangvien.thongtinsinhvien',['id_lop_hoc_phan'=>$id_lop_hoc_phan,'id_sinh_vien'=>$request->id_sinh_vien]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function xulythemthongbao(Request $request)
    {
        $thongbao = new ThongBao;

        {
            foreach($listsinhvien as $sinhvien)
            {
                $thongbao->fill([

                    "tieu_de" =>$request->tieu_de."-".$request->ten_lop_hoc_phan,
                    "noi_dung" =>$request->noi_dung,
                    "id_loai_thong_bao" => 3,
                    "id_giang_vien" => 1,
                    "id_sinh_vien" => $sinhvien->id
                    ]);
                $thongbao->save();
            }
        }
        return redirect('/giangvien/thongbao');
    }

    public function create()
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
        $thongbao=Thongbao::find($id);
        $thongbao->delete();
        $thongbao->save();
        return redirect('/giangvien/thongbao');
    }
}
