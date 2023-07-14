<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ThongBao;
use App\Models\SinhVien;
use App\Models\LopHocPhan;
use DB;
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
    public function laythongbao(Request $request)
    {
        $url=env('SERVER_URL').'/api/giang-vien/thong-bao/lay-thong-bao/'.$request->id;
        $l_post = $this->execGetRequest($url);
        $data = json_decode($l_post);
        $data_sv=array();
        if($request->type==1)
        {
            $url = env('SERVER_URL').'/api/danh-sach-sinh-vien-lhp/'.$request->id_lop_hoc;
            $l_post_sv = $this->execGetRequest($url);
            $data_sv = json_decode($l_post_sv );
        }
        else 
        {
            $url = env('SERVER_URL').'/api/danh-sach-sinh-vien-chu-nhiem/'.$request->id_lop_hoc;
            $l_post_sv = $this->execGetRequest($url);
            $data_sv = json_decode($l_post_sv );
        }
        

         $id_lop_hoc = $request->id_lop_hoc;
         $type = $request->type;
        
        dd( $data_sv );
        return view('giangvien.suathongbao',['thong_bao'=>$data->thong_bao,'danh_sach_sv_thong_bao'=>$data->danh_sach_sinh_vien,'danh_sach_sv'=>$data_sv,'id_lop_hoc'=>$id_lop_hoc,'type'=>$type]);
    }
    
    public function thongbaosinhvien()
    {
        return view('giangvien.thongbaosv');
    }
    public function diemsinhvien($id)
    {
        $url = env('SERVER_URL').'/api/giang-vien/lop-hoc-phan/bang-diem/'.$id;
        $l_diem_sv = $this->execGetRequest($url);
        $bang_diem_sv = json_decode($l_diem_sv );
        
        return view('giangvien.diemsinhvien',['bang_diem_sv'=> $bang_diem_sv,'id_lop_hoc_phan'=>$id]);
    }
    public function lopHocPhanCuaGiangVien(Request $request ){
        $url=env('SERVER_URL').'/api/giang-vien/thong-bao/danh-sach-thong-bao-lop-hoc-phan?id='.$request->id.'&type='.$request->type;
        $l_post = $this->execGetRequest($url);
        $danh_sach_thong_bao = json_decode($l_post);
        //Sửa ma_gv
        // $url = env('SERVER_URL').'/api/giang-vien/danh-sach-lop-hoc-phan/GVCNTT1?id_lop_hoc_phan='.$request->id.'&option=1';
        // $ds_sv = $this->execGetRequest($url);
        // $danh_sach_sinh_vien = json_decode($ds_sv);
   
        return view('giangvien.lophocphan',['id_lop_hoc_phan'=>$request->id,'danh_sach_thong_bao'=>$danh_sach_thong_bao]); 
    }
    public function lopHocChuNhiemCuaGiangVien(Request $request ){
        $url=env('SERVER_URL').'/api/giang-vien/thong-bao/danh-sach-thong-bao-lop-hoc-phan?id='.$request->id.'&type='.$request->type;
        $l_post = $this->execGetRequest($url);
        $danh_sach_thong_bao = json_decode($l_post);
        //Sửa ma_gv
        // $url = env('SERVER_URL').'/api/giang-vien/danh-sach-lop-hoc-phan/GVCNTT1?id_lop_hoc_phan='.$request->id.'&option=1';
        // $ds_sv = $this->execGetRequest($url);
        // $danh_sach_sinh_vien = json_decode($ds_sv);
   
        return view('giangvien.lopchunhiem',['id_lop_hoc'=>$request->id,'danh_sach_thong_bao'=>$danh_sach_thong_bao]); 
    }
    public function danhSachSinhVienTheoLopHocPhan($id){
        return view('giangvien.danhsachsinhvientheolop',['id_lop_hoc_phan'=>$id]);
    }
    // public function danhSachSinhVienTheoLopChuNhiem($id){
    //     return view('giangvien.danhsachsinhvientheolopChuNhiem',['id_lop_hoc'=>$id]);
    // }
    public function xemThongTinSinhVien($id_lop_hoc_phan,Request $request){
        return view('giangvien.thongtinsinhvien',['id_lop_hoc_phan'=>$id_lop_hoc_phan,'ma_sv'=>$request->ma_sv]);
    }

    function execGetRequest($url)
    {
        $accessToken = session()->get('access_token_gv');
        $ch = curl_init($url);
        // curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        // curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        //         'Content-Type: application/json',
        //         'Content-Length: ' . strlen($data))
        // );
        curl_setopt($ch,CURLOPT_HTTPHEADER,array("Authorization: Bearer $accessToken"));
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        return $result;
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    
    public function doimatkhau()
    {
        return view('giangvien.doimatkhau');
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
    public function show()
    {
        return view('giangvien.thongtingiangvien');
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
   
}
