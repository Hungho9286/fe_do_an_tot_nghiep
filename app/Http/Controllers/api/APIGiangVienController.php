<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Models\GiangVien;
use App\Models\ThongBao;


class APIGiangVienController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
    }
 
    public function xulythemthongbao(Request $request)
    {   
        $thongbao = new ThongBao;
        $thongbao->fill([
            "tieu_de" =>$request->tieu_de,
            "noi_dung" =>$request->noi_dung
            ]);
        $thongbao->save();
       
        return redirect('/giangvien/thongbao');
    }

    public function danhsachthongbao()
    {
        $listThongbaos=ThongBao::where('id_giang_vien',1)->get();
        $data=[];

        foreach($listThongbaos as $thongbao){
            $giangvien=GiangVien::find($thongbao->id_giang_vien);
            array_push($data,[
                'id'=>$thongbao->id,
                'id_giang_vien'=>$thongbao->id_giang_vien,
                'ten_giang_vien'=>$giangvien->ten_gv,
                'tieu_de'=>$thongbao->tieu_de,
                'noi_dung'=>$thongbao->noi_dung,
                'ngay_tao'=>$thongbao->created_at
            ]);

        }
        return $data;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return GiangVien::find($id);
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
      
    }
}
