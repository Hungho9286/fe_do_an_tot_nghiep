<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Models\SinhVien;
use App\Models\KhoaNganhPhongBan;
use App\Models\ChuyenNganh;
use App\Models\LopHocPhan;
use App\Models\MonHoc;
use App\Models\ChiTietLopHocPhan;
use App\Models\CtChuongTrinhDaoTao;
use App\Models\ChuongTrinhDaoTao;

class APISinhVienController extends Controller
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
        $sinhvien= SinhVien::find($id);
        $khoa_nganh=KhoaNganhPhongBan::find($sinhvien->id_khoa);
        $chuyen_nganh=ChuyenNganh::find($sinhvien->id_chuyen_nganh);
        return response()->json([
            'mssv'=>$sinhvien->mssv,
            'hoten'=>$sinhvien->hoten,
            'ngaysinh'=>$sinhvien->ngaysinh,
            'noisinh'=>$sinhvien->noisinh,
            'gioitinh'=>$sinhvien->gioitinh,
            'dantoc'=>$sinhvien->dantoc,
            'tongiao'=>$sinhvien->tongiao,
            'so_cmt'=>$sinhvien->so_cmt,
            'email'=>$sinhvien->email,
            'hinhanhdaidien'=>$sinhvien->hinhanhdaidien,
            'sodienthoai'=>$sinhvien->sodienthoai,
            'dia_chi_thuong_tru'=>$sinhvien->dia_chi_thuong_tru,
            'dia_chi_tam_tru'=>$sinhvien->dia_chi_tam_tru,
            'quoc_gia'=>$sinhvien->quoc_gia,
            'bacdaotao'=>$sinhvien->bacdaotao,
            'hedaotao'=>$sinhvien->hedaotao,
            'nien_khoa'=>$sinhvien->khoa_hoc.' - '.$sinhvien->khoa_hoc+3,
            'khoa_hoc'=>$sinhvien->khoa_hoc,
            'chuyen_nganh'=>$chuyen_nganh->ten,
            'khoa_nganh'=>$khoa_nganh->ten,
            'tinhtranghoc'=>$sinhvien->tinhtranghoc,
        ]
        );
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
    public function layBangDiemCuaSinhVien($id){
        $sinhvien=SinhVien::find($id);
        $chuongTrinhDaoTao=ChuongTrinhDaoTao::where('id_khoa',$sinhvien->id_khoa)->where('khoa',$sinhvien->khoa_hoc)->first();
        $ctChuongTrinhDaoTaos=CtChuongTrinhDaoTao::where('id_chuong_trinh_dao_tao',$chuongTrinhDaoTao->id)->get();
        $danhsachLopHocPhan=ChiTietLopHocPhan::where('id_sinh_vien',$id)->get();

        $data=array();
        foreach ($ctChuongTrinhDaoTaos as $item) {
            $monHoc=MonHoc::find($item->id_mon_hoc);
            $chiTietLopHocPhans=ChiTietLopHocPhan::join('lop_hoc_phans','chi_tiet_lop_hoc_phans.id_lop_hoc_phan','lop_hoc_phans.id')
                                                    ->join('ct_chuong_trinh_dao_taos','lop_hoc_phans.id_ct_chuong_trinh_dao_tao','ct_chuong_trinh_dao_taos.id')
                                                    ->where('ct_chuong_trinh_dao_taos.id_mon_hoc',$monHoc->id)
                                                    ->where('chi_tiet_lop_hoc_phans.id_sinh_vien',$sinhvien->id)
                                                    ->get();

            if($chiTietLopHocPhans->count()>1){
                $temp=$chiTietLopHocPhans->orderBy('tong_ket_1')->orderBy('tong_ket_2')->first();
                dd($temp);
                $data[]=array(
                    'ten_mon_hoc'=>$monHoc->ten,
                    'hoc_ki'=>$item->hocki,
                    'diem'=>$temp->tong_ket_1!=null?$temp->tong_ket_1:$temp->tong_ket_2
                );
            }else{
                if($chiTietLopHocPhans->count()==0){
                    $data[]=array(
                        'ten_mon_hoc'=>$monHoc->ten,
                        'hoc_ki'=>$item->hocki,
                        'diem'=>-1

                    );
                }else{
                    //dd($chiTietLopHocPhans->first()->tong_ket_1);
                    $data[]=array(
                    'ten_mon_hoc'=>$monHoc->ten,
                    'hoc_ki'=>$item->hocki,
                    'diem'=>$chiTietLopHocPhans->first()->tong_ket_1!=null?$chiTietLopHocPhans->first()->tong_ket_1:$chiTietLopHocPhans->first()->tong_ket_2
                    );
                }

            }
            // $lopHocPhan=LopHocPhan::find($item->id_lop_hoc_phan);
            // $ctChuongTrinhDaoTao=CtChuongTrinhDaoTao::find($lopHocPhan->id_ct_chuong_trinh_dao_tao);
            // $monHoc=MonHoc::find($ctChuongTrinhDaoTao->id_mon_hoc);
            // $data[]=array(
            //     'ten_mon_hoc'=>$monHoc->ten,
            //     'diem'=>$item->tong_ket_1!=null?$item->tong_ket_1:$item->tong_ket_2
            // );
        }
        //$json=json_encode($data);
        return $data;
    }
    public function layBangDiemCuaSinhVienTheoHocKy($id,$hocky){
        $sinhvien=SinhVien::find($id);
        $chuongTrinhDaoTao=ChuongTrinhDaoTao::where('id_khoa',$sinhvien->id_khoa)->where('khoa',$sinhvien->khoa_hoc)->first();
        $ctChuongTrinhDaoTaos=CtChuongTrinhDaoTao::where('id_chuong_trinh_dao_tao',$chuongTrinhDaoTao->id)->where('hocki',$hocky)->get();
        $danhsachLopHocPhan=ChiTietLopHocPhan::where('id_sinh_vien',$id)->get();

        $data=array();
        if($ctChuongTrinhDaoTaos->count()>0){
            foreach ($ctChuongTrinhDaoTaos as $item) {
                $monHoc=MonHoc::find($item->id_mon_hoc);
                $chiTietLopHocPhans=ChiTietLopHocPhan::join('lop_hoc_phans','chi_tiet_lop_hoc_phans.id_lop_hoc_phan','lop_hoc_phans.id')
                                                        ->join('ct_chuong_trinh_dao_taos','lop_hoc_phans.id_ct_chuong_trinh_dao_tao','ct_chuong_trinh_dao_taos.id')
                                                        ->where('ct_chuong_trinh_dao_taos.id_mon_hoc',$monHoc->id)
                                                        ->where('chi_tiet_lop_hoc_phans.id_sinh_vien',$sinhvien->id)
                                                        ->get();

                if($chiTietLopHocPhans->count()>1){
                    $temp=$chiTietLopHocPhans->orderBy('tong_ket_1')->orderBy('tong_ket_2')->first();
                    dd($temp);
                    $data[]=array(
                        'ten_mon_hoc'=>$monHoc->ten,
                        'hoc_ky'=>$item->hocki,
                        'diem'=>$temp->tong_ket_1!=null?$temp->tong_ket_1:$temp->tong_ket_2
                    );
                }else{
                    if($chiTietLopHocPhans->count()==0){
                        $data[]=array(
                            'ten_mon_hoc'=>$monHoc->ten,
                            'hoc_ky'=>$item->hocki,
                            'diem'=>-1

                        );
                    }else{
                        //dd($chiTietLopHocPhans->first()->tong_ket_1);
                        $data[]=array(
                        'ten_mon_hoc'=>$monHoc->ten,
                        'hoc_ky'=>$item->hocki,
                        'diem'=>$chiTietLopHocPhans->first()->tong_ket_1!=null?$chiTietLopHocPhans->first()->tong_ket_1:$chiTietLopHocPhans->first()->tong_ket_2
                        );
                    }

                }
                // $lopHocPhan=LopHocPhan::find($item->id_lop_hoc_phan);
                // $ctChuongTrinhDaoTao=CtChuongTrinhDaoTao::find($lopHocPhan->id_ct_chuong_trinh_dao_tao);
                // $monHoc=MonHoc::find($ctChuongTrinhDaoTao->id_mon_hoc);
                // $data[]=array(
                //     'ten_mon_hoc'=>$monHoc->ten,
                //     'diem'=>$item->tong_ket_1!=null?$item->tong_ket_1:$item->tong_ket_2
                // );
            }
            //$json=json_encode($data);
            return $data;
        }
        return response()->json(
            [
                'message'=>"Not Found",
            ]
            , 404);

    }
}
