<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckNoMon
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $accessToken = session()->get('access_token');
        $ma_sv=session()->get('ma_sv');
        $id_mon_hoc=$request->id_mon_hoc;
        $url=env('SERVER_URL')."/api/danh-sach-dang-ky-mon-cua-sinh-vien/".$ma_sv;
        $ch=curl_init($url);
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_HTTPHEADER,array("Authorization: Bearer $accessToken"));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $data=curl_exec($ch);
        $data=json_decode($data);
        //dd($data);
        curl_close($ch);
        //dd($data->dang_sach_mon_no);
        //dd($data);
        if($data->status==1){
            foreach($data->dang_sach_mon_no as $item){
                if($item->id_mon_hoc==$id_mon_hoc){
                    $url=env('SERVER_URL')."/api/sinh-vien-duoc-phep-vao-trang-dang-ky-mon?ma_sv=".$ma_sv."&id_mon_hoc=".$item->id_mon_hoc;
                    //dd($url);
                    $ch=curl_init($url);
                    curl_setopt($ch,CURLOPT_URL,$url);
                    curl_setopt($ch,CURLOPT_HTTPHEADER,array("Authorization: Bearer $accessToken"));

                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                    $dataChoPhepDangKyMon=curl_exec($ch);
                    $dataChoPhepDangKyMon=json_decode($dataChoPhepDangKyMon);
                    curl_close($ch);
                    //dd($dataChoPhepDangKyMon);
                    if($dataChoPhepDangKyMon->status==1){
                        return $next($request);
                    }
                }
            }
            return redirect()->route("trang-chu");
        }else{
            return redirect()->route("trang-chu");
        }
        return $next($request);
    }
}
