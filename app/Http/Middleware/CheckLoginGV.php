<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class checkLoginGV
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
       //$accessToken=$request->header('Authorization');
        //dd($request);
        
        $accessToken = session()->get('access_token_gv');

        $ma_gv=session()->get('ma_gv');
        // dd($accessToken);
        //    All Null
    
        // dd($accessToken);
        // //dd(session()->get('id_sinh_vien'));
        // //dd($id_sinh_vien);
        // //dd($accessToken);
        // dd($ma_gv);
        if($request->is('dang-nhap-giang-vien')&&($accessToken==null||$ma_gv==null)){
            return $next($request);
        }
        if($request->is('dang-nhap')&&($accessToken==null||$ma_gv==null)){
            return $next($request);
        }
        if($accessToken!=null){
            $url=env('SERVER_URL')."/api/kiem-tra-dang-nhap-gv?ma_gv=".$ma_gv;
            $ch = curl_init();
            curl_setopt($ch,CURLOPT_URL,$url);
            //curl_setopt($ch, CURLOPT_HEADER, TRUE);
            //curl_setopt($ch, CURLOPT_NOBODY, TRUE);
            curl_setopt($ch,CURLOPT_HTTPHEADER,array("Authorization: Bearer $accessToken"));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            $head = curl_exec($ch);
            curl_close($ch);
            $data=json_decode($head);
            // dd($data);
            //dd($data);
            if($request->is('dang-nhap')&&is_null($data)){
                return $next($request);
            }
            if(is_null($data)==false){
                if($request->is('dang-nhap')&&$data->status){
                    return redirect()->route('trang-chu-giang-vien');
                }
                if($data->status)
                    return $next($request);
            }


        }
        return redirect()->route('dang-nhap');
    }
}
