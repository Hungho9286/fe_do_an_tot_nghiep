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
    public function thongbaosinhvien()
    {
        return view('giangvien.thongbaosv');
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
        //
    }
}
