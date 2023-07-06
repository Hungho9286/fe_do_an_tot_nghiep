<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckLogin
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
        $accessToken = session()->get('access_token');
        $ma_sv=session()->get('ma_sv');
        
        //dd($ma_sv);
        //dd(session()->get('id_sinh_vien'));
        //dd($id_sinh_vien);
        //dd($accessToken);
        
        if($request->is('dang-nhap')&&($accessToken==null||$ma_sv==null)){
            $accessTokenGV = session()->get('access_token_gv');
            $ma_gv=session()->get('ma_gv');
            if($accessTokenGV!=null&&$ma_gv!=null){
                return redirect()->route('trang-chu-giang-vien');
            }
            return $next($request);
        }
        if($accessToken!=null){
            $url=env('SERVER_URL')."/api/check-login?ma_sv=".$ma_sv;

            $ch = curl_init();
            curl_setopt($ch,CURLOPT_URL,$url);
            //curl_setopt($ch, CURLOPT_HEADER, TRUE);
            //curl_setopt($ch, CURLOPT_NOBODY, TRUE);
            curl_setopt($ch,CURLOPT_HTTPHEADER,array("Authorization: Bearer $accessToken"));

            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            $head = curl_exec($ch);
            curl_close($ch);
            $data=json_decode($head);
            //dd($data);
            //dd($data);
            if($request->is('dang-nhap')&&is_null($data)){
                return $next($request);
            }
            if(is_null($data)==false){
                if($request->is('dang-nhap')&&$data->status){
                    return redirect()->route('trang-chu');
                }
                if($data->status)
                    return $next($request);
            }


        }
        return redirect()->route('dang-nhap');
    }
}
